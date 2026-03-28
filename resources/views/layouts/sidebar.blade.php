@php
    $user = Auth::user();
    $highestRole = $user->roles()->orderBy('level', 'desc')->first();
    $sidebarMenu = $highestRole ? $highestRole->getSidebarMenu() : [];
@endphp

<!-- Sidebar -->
<aside class="fixed left-0 top-0 h-screen w-64 bg-gradient-to-b from-green-800 to-green-900 text-white shadow-xl z-40 flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-green-700 flex-shrink-0">
        <div class="flex justify-center">
            <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center">
                <img src="/feedtan_logo.png" alt="FEEDTAN DIGITAL" class="w-12 h-12">
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto custom-scrollbar">
        @foreach($sidebarMenu as $item)
            <div class="nav-item">
                @if(isset($item['children']) && count($item['children']) > 0)
                    <!-- Dropdown Menu -->
                    <div class="dropdown">
                        @php
                            $hasActiveChild = false;
                            if (isset($item['children'])) {
                                foreach ($item['children'] as $child) {
                                    if (Route::has($child['route']) && request()->routeIs($child['route'])) {
                                        $hasActiveChild = true;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <button class="w-full flex items-center justify-between px-4 py-3 text-left rounded-lg {{ $hasActiveChild ? 'bg-green-700' : 'hover:bg-green-700' }} transition-colors duration-200 dropdown-toggle" onclick="toggleDropdown(this)">
                            <div class="flex items-center space-x-3">
                                @if($item['icon'])
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <x-lucide-icon name="{{ $item['icon'] }}" />
                                    </svg>
                                @endif
                                <span class="font-medium">{{ $item['title'] }}</span>
                            </div>
                            <svg class="w-4 h-4 transform transition-transform duration-200 dropdown-arrow {{ $hasActiveChild ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu {{ $hasActiveChild ? '' : 'hidden' }} mt-1 space-y-1">
                            @foreach($item['children'] as $child)
                                @if(Route::has($child['route']))
                                    @php
                                        $isActive = request()->routeIs($child['route']);
                                    @endphp
                                    <a href="{{ route($child['route']) }}" class="block pl-12 pr-4 py-3 text-sm {{ $isActive ? 'bg-green-700 bg-opacity-50 text-white' : 'text-white hover:bg-green-700 hover:bg-opacity-50' }} rounded transition-colors duration-200">
                                        {{ $child['title'] }}
                                    </a>
                                @else
                                    <span class="block pl-12 pr-4 py-3 text-sm text-white opacity-60 cursor-not-allowed">
                                        {{ $child['title'] }} (Coming Soon)
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Single Menu Item -->
                    @if(Route::has($item['route']))
                        @php
                            $isActive = request()->routeIs($item['route']);
                        @endphp
                        <a href="{{ route($item['route']) }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ $isActive ? 'bg-green-700' : 'hover:bg-green-700' }} transition-colors duration-200">
                            @if($item['icon'])
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <x-lucide-icon name="{{ $item['icon'] }}" />
                                </svg>
                            @endif
                            <span class="font-medium">{{ $item['title'] }}</span>
                        </a>
                    @else
                        <div class="flex items-center space-x-3 px-4 py-3 rounded-lg opacity-50 cursor-not-allowed">
                            @if($item['icon'])
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <x-lucide-icon name="{{ $item['icon'] }}" />
                                </svg>
                            @endif
                            <span class="font-medium">{{ $item['title'] }} (Coming Soon)</span>
                        </div>
                    @endif
                @endif
            </div>
        @endforeach
    </nav>
</aside>

<script>
// Dropdown functionality
function toggleDropdown(button) {
    console.log('Dropdown clicked'); // Debug log
    const dropdown = button.closest('.dropdown');
    const menu = dropdown.querySelector('.dropdown-menu');
    const arrow = dropdown.querySelector('.dropdown-arrow');
    
    // Close other dropdowns
    document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
        if (otherMenu !== menu) {
            otherMenu.classList.add('hidden');
            otherMenu.closest('.dropdown').querySelector('.dropdown-arrow').classList.remove('rotate-180');
        }
    });
    
    // Toggle current dropdown
    menu.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
        document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
            arrow.classList.remove('rotate-180');
        });
    }
});

// Initialize dropdowns when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dropdowns initialized'); // Debug log
});
</script>
