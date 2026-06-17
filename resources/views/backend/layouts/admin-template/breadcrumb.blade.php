@isset($page_content)
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-right">
                <ol class="breadcrumb m-0" style="background: transparent; list-style: none; display: flex; align-items: center; gap: 8px; font-size: 0.9rem;">

                    <!-- Home Icon -->
                    <li class="breadcrumb-item" style="display: flex; align-items: center;">
                        <a href="{{ route('home') }}" style="text-decoration: none; color: #007bff; font-weight: bold;">
                            <i class="bx bx-home" style="color: #17a2b8; margin-right: 5px; font-size: 1.1rem;"></i> HOME
                        </a>
                    </li>

                    @isset($page_content['module_name'])
                        <!-- Divider Icon -->
                        <li style="color: #6c757d;">
                            <i class="bx bx-chevron-right" style="font-size: 0.8rem;"></i>
                        </li>

                        <!-- Module Icon -->
                        <li class="breadcrumb-item" style="display: flex; align-items: center;">
                            <a href="{{ $page_content['module_route'] ?? '#' }}" style="text-decoration: none; color: #6c757d; font-weight: 500;">
                                <i class="bx bx-folder" style="color: #ffc107; margin-right: 5px; font-size: 1.1rem;"></i>
                                {{ $page_content['module_name'] ?? 'Module' }}
                            </a>
                        </li>
                    @endisset

                    @isset($page_content['sub_module_name'])
                        <!-- Divider Icon -->
                        <li style="color: #6c757d;">
                            <i class="bx bx-chevron-right" style="font-size: 0.8rem;"></i>
                        </li>

                        <!-- Sub-Module Icon -->
                        <li class="breadcrumb-item active" style="display: flex; align-items: center; color: #6c757d;">
                            <i class="bx bx-file" style="color: #dc3545; margin-right: 5px; font-size: 1.1rem;"></i>
                            {{ $page_content['sub_module_name'] ?? 'Sub-Module' }}
                        </li>
                    @endisset

                </ol>
            </div>
        </div>
    </div>
@endisset
