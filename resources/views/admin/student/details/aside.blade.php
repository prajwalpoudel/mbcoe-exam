<!--Begin:: App Aside-->
<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
    <div class="kt-portlet ">
        <div class="kt-portlet__head  kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit-y">
            <!--begin::Widget -->
            <div class="kt-widget kt-widget--user-profile-1">
                <div class="kt-widget__head">
                    <div class="kt-widget__content">
                        <div class="kt-widget__section">
                            <p class="kt-widget__username">
                                {{ $student->user->name ?? "N/R" }}
                            </p>
                            <span class="kt-widget__subtitle">
                                {{ "Faculty of ".$student->faculty->name ?? "N/R" }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="kt-widget__body">
                    <div class="kt-widget__content">
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Email:</span>
                            <span class="kt-widget__data">{{ $student->user->email ?? "N/R" }}</span>
                        </div>
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Phone:</span>
                            <span class="kt-widget__data">{{ $student->user->phone ?? "N/R" }}</span>
                        </div>
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Location:</span>
                            <span class="kt-widget__data">{{ $student->user->address ?? "N/R" }}</span>
                        </div>
                    </div>
                    <div class="kt-widget__items">
                        <a href="{{ route('admin.student.show', $student->id) }}" class="kt-widget__item {{ request()->route()->getName() == "admin.student.show" ?  "kt-widget__item--active" : ""}}">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <i class="la la-user"></i>
                                </span>
                                <span class="kt-widget__desc">
                                    Profile Overview
                                </span>
                            </span>
                        </a>
                        <a href="{{ route('admin.student.semester', $student->id) }}" class="kt-widget__item {{ request()->route()->getName() == "admin.student.semester" ?  "kt-widget__item--active" : ""}}">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <i class="la la-book"></i>
                                </span>
                                <span class="kt-widget__desc">
                                    Semesters
                                </span>
                            </span>
                        </a>
                        <a href="{{ route('admin.student.result', $student->id) }}" class="kt-widget__item {{ in_array(request()->route()->getName(), ['admin.student.result', 'admin.student.result.create', 'admin.student.result.edit'])  ?  "kt-widget__item--active" : "" }}">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <i class="la la-random"></i>
                                </span>
                                <span class="kt-widget__desc">
                                    Results
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!--end::Widget -->
        </div>
    </div>
</div>

<!--End:: App Aside-->
