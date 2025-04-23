<!-- resources/views/layouts/sidebar.blade.php -->
<div class="aside-menu flex-column-fluid px-4 bg-white shadow-lg"
    style="width: 250px; height: 90vh; position: fixed; left: 30px; top: 100px; border-radius: 10px; padding: 30px;">
    <div class="hover-scroll-overlay-y mh-100 my-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="{default: '#kt_aside_footer', lg: '#kt_header, #kt_aside_footer'}"
        data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="{default: '5px', lg: '75px'}"
        style="height: 100%;">

        <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_aside_menu"
            data-kt-menu="true">

            <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-element-11 fs-2">
                            <span class="path1"></span><span class="path2"></span>
                            <span class="path3"></span><span class="path4"></span>
                        </i>
                    </span>
                    <span class="menu-title">Todo</span>
                    <span class="menu-arrow"></span>
                </span>

                <div class="menu-sub menu-sub-accordion">

                    <div class="menu-item">
                        <a class="menu-link active" href="{{ url('/todo') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Todo Page</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
