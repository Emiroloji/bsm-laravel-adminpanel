{{-- resources/views/layouts/sidebar.blade.php --}}

{{-- Sidebar (always visible) --}}
<aside class="aside-menu flex-column-fluid px-4 bg-white shadow-lg mb-4"
    style="max-width: 250px; width: 100%; height: calc(90vh - 20px); position: fixed; left: 30px; top: 100px; border-radius: 10px; padding: 30px; margin-bottom: 20px;">
    <div class="hover-scroll-overlay-y mh-100 my-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="{default: '#kt_aside_footer', lg: '#kt_header, #kt_aside_footer'}"
        data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="{default: '5px', lg: '75px'}"
        style="height: 100%;">
        <nav class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" data-kt-menu="true">
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Dashboard</span>
                </div>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ url('/') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title fw-bold text-uppercase fs-7">Anasayfa</span>
                </a>
            </div>

            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Todo</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-address-book fs-2">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                        </i>
                    </span>
                    <span class="menu-title">Todo Page</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ url('/todo') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title fw-bold text-uppercase fs-7">Todo</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</aside>

{{-- If you wish to use offcanvas on mobile, keep this section and add a toggle button somewhere in your layout: --}}
{{--
<button class="btn btn-icon d-lg-none mb-3" type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#kt_aside_offcanvas"
        aria-controls="kt_aside_offcanvas">
    <i class="ki-duotone ki-element-11 fs-1"></i>
</button>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="kt_aside_offcanvas"
     aria-labelledby="kt_aside_offcanvas_label">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="kt_aside_offcanvas_label">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <div class="list-group list-group-flush">
            <a href="{{ url('/') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="ki-duotone ki-element-11 fs-2 me-2"></i>
                <span>Anasayfa</span>
            </a>
            <a href="{{ url('/todo') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="ki-duotone ki-element-11 fs-2 me-2"></i>
                <span>Todo Page</span>
            </a>
        </div>
    </div>
</div>
--}}
