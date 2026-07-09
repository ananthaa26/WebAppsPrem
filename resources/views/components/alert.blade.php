<!-- Komponen Global Toast/Alert -->
<div id="toastContainer" class="toast-container"></div>

<script>
    // ===== GLOBAL TOAST SYSTEM =====
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        
        // Icon checkmark untuk sukses, silang untuk error
        const iconSvg = type === 'success' 
            ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="width: 14px; height: 14px;"><polyline points="20 6 9 17 4 12"></polyline></svg>'
            : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="width: 14px; height: 14px;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';

        toast.innerHTML = `
            <div class="toast-icon">${iconSvg}</div>
            <div>${message}</div>
        `;
        
        container.appendChild(toast);
        
        // Trigger animasi masuk
        setTimeout(() => toast.classList.add('show'), 10);
        
        // Hapus otomatis setelah 3 detik
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
</script>
