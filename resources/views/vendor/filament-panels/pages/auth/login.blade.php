<x-filament-panels::page.simple>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
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

    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}

</x-filament-panels::page.simple>
