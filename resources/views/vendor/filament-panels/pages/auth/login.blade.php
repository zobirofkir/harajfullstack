<style>
.modal-overlay {
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 50;
}

.modal-content {
    background-color: white;
    padding: 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 24rem;
    text-align: center;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 1rem;
    color: rgb(0, 0, 0);
}

.modal-message {
    margin-bottom: 1.5rem;
    color: rgb(117, 117, 117);
}

.modal-footer {
    margin-top: 1rem;
}

.modal-close-btn {
    padding: 0.5rem 1.5rem;
    background-color: #6c757d;
    color: white;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1rem;
}

.modal-close-btn:hover {
    background-color: #5a6268;
}

.modal-link {
    color: rgb(0, 81, 255);
}

</style>

<x-filament-panels::page.simple>
    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}
            {{ $this->registerAction }}
        </x-slot>
    @endif

    <div class="text-center mt-4">
        <a href="{{url('/')}}" class="btn btn-link text-decoration-none text-muted">العودة إلى الصفحة الرئيسية</a>
    </div>

    <div class="text-center mt-4" x-data="{ open: false }">
        <a href="#" @click.prevent="open = true" class="btn btn-primary">تسجيل الدخول كمسؤول</a>

        <!-- Modal -->
        <div x-show="open" class="modal-overlay">
            <div class="modal-content">
                <h3 class="modal-title">تنبيه</h3>
                <p class="modal-message">اتصل بالمسؤول لإنشاء حساب مسؤول لك</p>
                <a href="mailto:contact@deenalisa.com" class="modal-link">contact@deenalisa.com</a>
                <div class="modal-footer">
                    <button @click="open = false" class="modal-close-btn">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <x-filament-panels::form id="form" wire:submit="authenticate" class="mt-4">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
</x-filament-panels::page.simple>
