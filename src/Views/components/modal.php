<div id="modal-root" class="hidden fixed inset-0 z-[10000] flex items-center justify-center p-4"
     style="background:rgba(0,0,0,0.6);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px)">
    <div id="modal-card"
         class="w-full max-w-md bg-[#18181b] border border-white/10 rounded-2xl shadow-2xl p-6 relative"
         style="transform:scale(0.95) translateY(10px);opacity:0;transition:transform 200ms cubic-bezier(0.16,1,0.3,1),opacity 200ms ease-out">
        <button id="modal-close" type="button"
                class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center rounded-lg text-muted hover:text-text hover:bg-white/5 transition-all duration-150 cursor-pointer border-0 bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
        </button>
        <div id="modal-icon" class="mb-4"></div>
        <h3 id="modal-title" class="text-lg font-bold text-white font-display mb-2 pr-6"></h3>
        <p id="modal-message" class="text-sm text-muted leading-relaxed mb-6"></p>
        <div id="modal-actions" class="flex items-center justify-end gap-3"></div>
    </div>
</div>
