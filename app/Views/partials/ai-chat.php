<?php
declare(strict_types=1);
?>

<!-- ==============================================================================
     FİZYOBAR AI ASİSTANI (SADE FİZYOTERAPİ İKONLU & MİNİMALİST DRAWER)
     ============================================================================== -->

<!-- 1. Sağ Alt Köşe Butonu (Sadece İkon - Anlaşılır, Şık ve Kompakt) -->
<div class="ai-chat-balloon-wrap" id="aiChatBalloonWrap">
    <button type="button" class="ai-chat-balloon" id="aiChatBalloon" aria-label="Fizyobar AI Asistanı" aria-expanded="false" title="Fizyobar AI Asistanı">
        <span class="ai-balloon-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                <circle cx="8" cy="10" r="1.25" fill="currentColor"></circle>
                <circle cx="12" cy="10" r="1.25" fill="currentColor"></circle>
                <circle cx="16" cy="10" r="1.25" fill="currentColor"></circle>
            </svg>
        </span>
        <span class="ai-online-dot" title="Çevrimiçi"></span>
    </button>
</div>

<!-- 2. Akıllı Sohbet Çekmecesi (Chat Drawer / Popup) -->
<div class="ai-chat-drawer" id="aiChatDrawer" aria-hidden="true" role="dialog" aria-labelledby="aiChatTitle">
    <!-- Header: Sade - Sadece FİZYOBAR AI ASİSTAN ve Kapatma Butonu -->
    <div class="ai-drawer-header">
        <h3 class="ai-drawer-title" id="aiChatTitle">FİZYOBAR AI ASİSTAN</h3>
        <button type="button" class="ai-drawer-close" id="aiChatCloseBtn" aria-label="Sohbeti Kapat">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- Chat Messages Flow -->
    <div class="ai-drawer-body" id="aiChatMessages">
        <div class="ai-msg-group ai-msg-bot">
            <div class="ai-msg-bubble">
                <p>Merhaba! Ben <strong>Fizyobar AI Asistanıyım</strong> 🌿</p>
                <p>Fizyoterapist <strong>Betina Tansuğ</strong> metodolojisiyle sana özel en uygun programı seçmende, omurga/postür şikayetlerinde ve beslenme rutinlerinde yardımcı olmak için buradayım.</p>
                <p>Bugün nasıl hissediyorsun veya hangi konuda destek almak istersin?</p>
            </div>
            <span class="ai-msg-time">Şimdi</span>
        </div>

        <!-- Hızlı Öneri Hapları (Quick Chips) -->
        <div class="ai-chat-chips" id="aiChatChips">
            <button type="button" class="ai-chip" data-query="Bana en uygun program hangisi?">🎯 Bana Uygun Programı Bul</button>
            <button type="button" class="ai-chip" data-query="4 Haftalık Online Kamp detayları nelerdir?">🧘 4 Haftalık Online Kamp Nedir?</button>
            <button type="button" class="ai-chip" data-query="Sırt ve boyun ağrılarım için ne yapabilirim?">🦴 Sırt &amp; Boyun Ağrım Var</button>
            <button type="button" class="ai-chip" data-query="GLP-1 ve rafine şekersiz beslenme nasıl uygulanıyor?">🥗 GLP-1 &amp; Beslenme</button>
            <button type="button" class="ai-chip" data-query="whatsapp">💬 WhatsApp'tan Fizyoterapiste Yaz</button>
        </div>
    </div>

    <!-- Typing Indicator -->
    <div class="ai-typing-indicator" id="aiTypingIndicator" style="display: none;">
        <span class="typing-text">Fizyobar AI yanıt hazırlıyor</span>
        <div class="typing-dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Footer Input Bar -->
    <form class="ai-drawer-footer" id="aiChatForm" autocomplete="off">
        <input 
            type="text" 
            class="ai-input-field" 
            id="aiChatInput" 
            placeholder="Sorunuzu veya şikayetinizi yazın..." 
            maxlength="400"
            required
        >
        <button type="submit" class="ai-send-btn" id="aiChatSubmitBtn" aria-label="Gönder">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" y1="2" x2="11" y2="13"></line>
                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
        </button>
    </form>
</div>
