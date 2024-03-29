<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('getting_started_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.getting-starteds.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/getting-starteds") || request()->is("admin/getting-starteds/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-walking c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.gettingStarted.title') }}
                </a>
            </li>
        @endcan
        @can('public_information_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/public-officials*") ? "c-show" : "" }} {{ request()->is("admin/internal-investigations*") ? "c-show" : "" }} {{ request()->is("admin/records*") ? "c-show" : "" }} {{ request()->is("admin/reports*") ? "c-show" : "" }} {{ request()->is("admin/vehicles*") ? "c-show" : "" }} {{ request()->is("admin/agencies-offices*") ? "c-show" : "" }} {{ request()->is("admin/public-records*") ? "c-show" : "" }} {{ request()->is("admin/public-official-datas*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.publicInformation.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('public_official_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.public-officials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/public-officials") || request()->is("admin/public-officials/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.publicOfficial.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('internal_investigation_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.internal-investigations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/internal-investigations") || request()->is("admin/internal-investigations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-search c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.internalInvestigation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('record_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.records.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/records") || request()->is("admin/records/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.record.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reports") || request()->is("admin/reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.report.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('vehicle_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.vehicles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/vehicles") || request()->is("admin/vehicles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-taxi c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.vehicle.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('agencies_office_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.agencies-offices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/agencies-offices") || request()->is("admin/agencies-offices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.agenciesOffice.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('public_record_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.public-records.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/public-records") || request()->is("admin/public-records/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.publicRecord.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('public_official_data_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.public-official-datas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/public-official-datas") || request()->is("admin/public-official-datas/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.publicOfficialData.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('member_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/investigating-governments*") ? "c-show" : "" }} {{ request()->is("admin/case-laws*") ? "c-show" : "" }} {{ request()->is("admin/open-records-infos*") ? "c-show" : "" }} {{ request()->is("admin/forms*") ? "c-show" : "" }} {{ request()->is("admin/submit-records*") ? "c-show" : "" }} {{ request()->is("admin/donations*") ? "c-show" : "" }} {{ request()->is("admin/portal-requests*") ? "c-show" : "" }} {{ request()->is("admin/reportbugs*") ? "c-show" : "" }} {{ request()->is("admin/change-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.member.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('investigating_government_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.investigating-governments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/investigating-governments") || request()->is("admin/investigating-governments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-secret c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.investigatingGovernment.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('case_law_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.case-laws.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/case-laws") || request()->is("admin/case-laws/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-gavel c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.caseLaw.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('open_records_info_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.open-records-infos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/open-records-infos") || request()->is("admin/open-records-infos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-copy c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.openRecordsInfo.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('form_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.forms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/forms") || request()->is("admin/forms/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-copy c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.form.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('submit_record_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.submit-records.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/submit-records") || request()->is("admin/submit-records/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-share-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.submitRecord.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('donation_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.donations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/donations") || request()->is("admin/donations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.donation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('portal_request_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.portal-requests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/portal-requests") || request()->is("admin/portal-requests/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.portalRequest.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('reportbug_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reportbugs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reportbugs") || request()->is("admin/reportbugs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bug c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.reportbug.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('change_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.change-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/change-logs") || request()->is("admin/change-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-atlas c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.changeLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/portal-versions*") ? "c-show" : "" }} {{ request()->is("admin/bugs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('portal_version_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.portal-versions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/portal-versions") || request()->is("admin/portal-versions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-vuejs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.portalVersion.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bug_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bugs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bugs") || request()->is("admin/bugs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bug c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bug.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>