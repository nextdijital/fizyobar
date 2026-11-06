/**
 * Fizyobar AI Asistan İstemci Komut Dosyası (Vanilla JS)
 * Sıfır harici kütüphane bağımlılığı, ultra hafif (~3KB) ve yüksek performanslı.
 */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const balloonWrap = document.getElementById('aiChatBalloonWrap');
        const balloonBtn = document.getElementById('aiChatBalloon');
        const drawer = document.getElementById('aiChatDrawer');
        const closeBtn = document.getElementById('aiChatCloseBtn');
        const chatForm = document.getElementById('aiChatForm');
        const chatInput = document.getElementById('aiChatInput');
        const messagesContainer = document.getElementById('aiChatMessages');
        const typingIndicator = document.getElementById('aiTypingIndicator');

        if (!balloonBtn || !drawer || !chatForm) {
            return;
        }

        // 1. Çekmeceyi Aç / Kapat
        function openDrawer() {
            drawer.classList.add('is-open');
            drawer.setAttribute('aria-hidden', 'false');
            balloonBtn.setAttribute('aria-expanded', 'true');
            if (balloonWrap) {
                balloonWrap.style.display = 'none'; // Çekmece açılınca balon gizlenir
            }
            setTimeout(() => {
                chatInput && chatInput.focus();
                scrollToBottom();
            }, 150);
        }

        function closeDrawer() {
            drawer.classList.remove('is-open');
            drawer.setAttribute('aria-hidden', 'true');
            balloonBtn.setAttribute('aria-expanded', 'false');
            if (balloonWrap) {
                balloonWrap.style.display = 'block'; // Çekmece kapanınca balon görünür
            }
        }

        balloonBtn.addEventListener('click', openDrawer);
        closeBtn && closeBtn.addEventListener('click', closeDrawer);

        // ESC tuşu ile kapatma
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
                closeDrawer();
            }
        });

        // 2. Mesajları Aşağı Kaydırma
        function scrollToBottom() {
            if (messagesContainer) {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        }

        // 3. Basit ve Güvenli Markdown / Metin Dönüştürücü
        function formatAiReply(text) {
            if (!text) return '';
            
            // XSS koruması için önce HTML kaçır
            let safe = text
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');

            // **kalın** -> <strong>
            safe = safe.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

            // • Madde işaretleri
            safe = safe.replace(/^• (.*)$/gm, '<li>$1</li>');
            safe = safe.replace(/(<li>.*<\/li>)/s, '<ul style="margin:6px 0;padding-left:18px;">$1</ul>');

            // Satır sonları
            const paragraphs = safe.split(/\n\n+/);
            return paragraphs.map(p => {
                if (p.startsWith('<ul') || p.startsWith('<li')) {
                    return p;
                }
                return `<p>${p.replace(/\n/g, '<br>')}</p>`;
            }).join('');
        }

        // 4. Mesaj Balonu Ekleme
        function appendUserMessage(text) {
            const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const group = document.createElement('div');
            group.className = 'ai-msg-group ai-msg-user';
            group.innerHTML = `
                <div class="ai-msg-bubble">
                    <p>${text.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
                </div>
                <span class="ai-msg-time">${timeStr}</span>
            `;
            messagesContainer.appendChild(group);
            scrollToBottom();
        }

        function appendBotMessage(text, chips = []) {
            const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const group = document.createElement('div');
            group.className = 'ai-msg-group ai-msg-bot';
            group.innerHTML = `
                <div class="ai-msg-bubble">
                    ${formatAiReply(text)}
                </div>
                <span class="ai-msg-time">${timeStr}</span>
            `;
            messagesContainer.appendChild(group);

            // Eğer yeni öneri hapları varsa ekle
            if (chips && chips.length > 0) {
                const chipsWrap = document.createElement('div');
                chipsWrap.className = 'ai-chat-chips';
                chips.forEach(chipText => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'ai-chip';
                    btn.textContent = chipText;
                    btn.setAttribute('data-query', chipText);
                    chipsWrap.appendChild(btn);
                });
                messagesContainer.appendChild(chipsWrap);
            }

            scrollToBottom();
        }

        // 5. Sunucuya İstek Gönderme
        async function sendQuery(queryText) {
            const trimmed = queryText.trim();
            if (!trimmed) return;

            appendUserMessage(trimmed);

            // WhatsApp yönlendirme kestirmesi
            if (trimmed.toLowerCase().includes('whatsapp')) {
                const waUrl = "https://wa.me/905321234567?text=" + encodeURIComponent("Merhaba Betina Hocam, Fizyobar programları hakkında danışmak istiyorum.");
                setTimeout(() => {
                    appendBotMessage(
                        "Sizi doğrudan **Fizyoterapist Betina Tansuğ**'un WhatsApp hattına yönlendiriyorum.\n\nAşağıdaki butona tıklayarak anında sohbete başlayabilirsiniz: \n\n👉 <a href='" + waUrl + "' target='_blank' rel='noopener noreferrer' style='display:inline-block;margin-top:6px;background:#25D366;color:#ffffff;padding:6px 14px;border-radius:999px;font-weight:700;text-decoration:none;'>WhatsApp ile Bağlan &rarr;</a>",
                        ['4 Haftalık Online Kamp Detayları', 'Bana Uygun Programı Bul']
                    );
                }, 400);
                return;
            }

            // Yazıyor göstergesini aç
            if (typingIndicator) {
                typingIndicator.style.display = 'flex';
                scrollToBottom();
            }

            const basePath = (window.Fizyobar && window.Fizyobar.basePath) ? window.Fizyobar.basePath : '';
            const apiUrl = (basePath ? basePath : '') + '/api/ai-chat';

            try {
                const res = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': (window.Fizyobar && window.Fizyobar.csrfToken) || ''
                    },
                    body: JSON.stringify({ message: trimmed })
                });

                const data = await res.json();

                if (typingIndicator) {
                    typingIndicator.style.display = 'none';
                }

                if (data && data.success) {
                    appendBotMessage(data.reply, data.chips);
                } else {
                    appendBotMessage(data.reply || 'Şu anda yanıt üretilemedi, lütfen tekrar deneyin.');
                }
            } catch (err) {
                if (typingIndicator) {
                    typingIndicator.style.display = 'none';
                }
                appendBotMessage('Bağlantı kurulurken bir sorun oluştu. Dilerseniz sorularınızı doğrudan WhatsApp üzerinden Betina Hoca\'ya iletebilirsiniz: <br><a href="https://wa.me/905321234567" target="_blank" style="color:#391214;font-weight:700;">WhatsApp Hattı &rarr;</a>');
            }
        }

        // 6. Form Submit Olayı
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = chatInput.value;
            chatInput.value = '';
            sendQuery(msg);
        });

        // 7. Hızlı Öneri Hapları Tıklama Delegasyonu
        messagesContainer.addEventListener('click', function(e) {
            const chip = e.target.closest('.ai-chip');
            if (chip) {
                const query = chip.getAttribute('data-query') || chip.textContent;
                sendQuery(query);
            }
        });
    });
})();
