@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="my-12">
        <!-- Version mobile -->
        <div class="flex justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-6 py-3 text-sm font-medium text-gray-300 bg-gray-50 rounded-full cursor-not-allowed transition-all duration-300 transform hover:scale-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative inline-flex items-center px-6 py-3 text-sm font-medium text-gray-600 bg-white rounded-full shadow-lg hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative inline-flex items-center px-6 py-3 text-sm font-medium text-gray-600 bg-white rounded-full shadow-lg hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-105">
                    {!! __('pagination.next') !!}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-6 py-3 text-sm font-medium text-gray-300 bg-gray-50 rounded-full cursor-not-allowed transition-all duration-300 transform hover:scale-100">
                    {!! __('pagination.next') !!}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            @endif
        </div>

        <!-- Version desktop -->
        <div class="hidden sm:flex sm:flex-col sm:items-center">
            <!-- Pagination controls container -->
            <div class="flex w-full justify-center items-center max-w-4xl mx-auto">
                <div class="flex items-center justify-between w-full px-2 py-2 bg-white rounded-full shadow-lg">
                    <!-- Info section -->
                    <div class="px-5 py-2.5 text-sm text-gray-600 font-medium">
                        <span>{!! __('Showing') !!}</span>
                        @if ($paginator->firstItem())
                            <span class="font-bold text-indigo-700">{{ $paginator->firstItem() }}</span>
                            <span class="text-gray-500 mx-1">{!! __('to') !!}</span>
                            <span class="font-bold text-indigo-700">{{ $paginator->lastItem() }}</span>
                        @else
                            {{ $paginator->count() }}
                        @endif
                        <span class="text-gray-500 mx-1">{!! __('of') !!}</span>
                        <span class="font-bold text-indigo-700">{{ $paginator->total() }}</span>
                        <span>{!! __('results') !!}</span>
                    </div>

                    <!-- Navigation buttons -->
                    <div class="flex items-center bg-gray-50 rounded-full">
                        {{-- Bouton Précédent --}}
                        @if ($paginator->onFirstPage())
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                                class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 cursor-not-allowed transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </span>
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gradient-to-l hover:from-indigo-100 hover:to-purple-100 hover:text-indigo-700 focus:z-10 focus:outline-none transition-all duration-300 rounded-l-full"
                                aria-label="{{ __('pagination.previous') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </a>
                        @endif

                        {{-- Éléments de pagination --}}
                        @foreach ($elements as $element)
                            {{-- Séparateur "..." --}}
                            @if (is_string($element))
                                <span aria-disabled="true"
                                    class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-50">
                                    <span class="font-bold">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Liens de pagination --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <span aria-current="page"
                                            class="relative inline-flex items-center justify-center w-10 h-10 mx-1 text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-purple-600 cursor-default rounded-full">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="relative inline-flex items-center justify-center w-10 h-10 mx-1 text-sm font-medium text-gray-600 hover:bg-indigo-100 hover:text-indigo-700 focus:z-10 focus:outline-none transition-all duration-300 rounded-full"
                                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Bouton Suivant --}}
                        @if ($paginator->hasMorePages())
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                                class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gradient-to-r hover:from-indigo-100 hover:to-purple-100 hover:text-indigo-700 focus:z-10 focus:outline-none transition-all duration-300 rounded-r-full"
                                aria-label="{{ __('pagination.next') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                                class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 cursor-not-allowed transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endif
