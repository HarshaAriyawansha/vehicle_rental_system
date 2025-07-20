<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
        @if(request()->route()->getName() == 'home')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-laptop fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Dashboard</li>
            </ol>

        <!-- user account -->
        @elseif(request()->route()->getName() == 'users')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;User Account</li>
            </ol>
        @elseif(request()->route()->getName() == 'user_create')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;User Account</li>
                <li class="breadcrumb-item active" aria-current="page">Create User</li>
            </ol>
        @elseif(request()->route()->getName() == 'user_edit')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;User Account</li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        <!-- role -->
        @elseif(request()->route()->getName() == 'roles')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Role</li>
            </ol>
        @elseif(request()->route()->getName() == 'roles_create')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Role</li>
                <li class="breadcrumb-item active" aria-current="page">Create Role</li>
            </ol>
        @elseif(request()->route()->getName() == 'roles_edit')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Role</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
            </ol>
        @elseif(request()->route()->getName() == 'givepermission')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Role</li>
                <li class="breadcrumb-item active" aria-current="page">Give Permission</li>
            </ol>
        <!-- permission -->
        @elseif(request()->route()->getName() == 'permissions')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Permission</li>
            </ol>
        @elseif(request()->route()->getName() == 'permissions_create')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Permission</li>
                <li class="breadcrumb-item active" aria-current="page">Create Permission</li>
            </ol>
        @elseif(request()->route()->getName() == 'permissions_edit')
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Permission</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
            </ol>

        <!-- vehicle brand management -->
        @elseif(request()->route()->getName() == 'brand')
            <ol class="breadcrumb mb-0 p-0">
                <!--<li class="breadcrumb-item active" aria-current="page">Vehicle</li>-->
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-car fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Brand</li>
            </ol>

        <!-- vehicle model management -->
        @elseif(request()->route()->getName() == 'model')
            <ol class="breadcrumb mb-0 p-0">
                <!--<li class="breadcrumb-item active" aria-current="page">Vehicle</li>-->
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-car fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Model</li>
            </ol>
        
        <!-- Today -->
        <!-- vehicle name management -->
        @elseif(request()->route()->getName() == 'vehicle')
            <ol class="breadcrumb mb-0 p-0">
                <!--<li class="breadcrumb-item active" aria-current="page">&nbsp;Vehicle</li>-->
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-car fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Vehicle</li>
            </ol>


        <!-- Booking management -->
        @elseif(request()->route()->getName() == 'booking')
            <ol class="breadcrumb mb-0 p-0">
                <!--<li class="breadcrumb-item active" aria-current="page">Booking</li>-->
                <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-book fa-lg" style="color:rgb(57, 169, 255);"></i>&nbsp;Booking</li>
            </ol>
        @endif
       
        </nav>
    </div>
</div>
    <!--end breadcrumb-->