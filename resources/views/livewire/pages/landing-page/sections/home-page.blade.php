<div>

    <livewire:components.navbar :currentPage="$currentPage" />

    {{-- HOME --}}
    @if($currentPage === 'home')
        <livewire:sections.landing.hero />
        <livewire:sections.landing.features />
        <livewire:sections.landing.how-it-works />
        <livewire:sections.landing.criteria />
        <livewire:sections.landing.cta />
    @endif

    {{-- MOTOR --}}
    @if($currentPage === 'motor')
        <livewire:sections.landing.motor-list />
    @endif

    {{-- ABOUT --}}
    @if($currentPage === 'about')
        <livewire:sections.landing.about />
    @endif

    <livewire:components.footer />

</div>