@extends('layouts.app')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'FEEDTAN DIGITAL')
@section('page-description', 'Advanced analytics and comprehensive system management')

@section('content')
<!-- Key Performance Indicators -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Users</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                <div class="mt-2 flex items-center text-sm">
                    <span class="text-green-600 font-medium">+{{ $stats['user_growth']['this_month'] - $stats['user_growth']['last_month'] > 0 ? '' : '' }}{{ abs($stats['user_growth']['this_month'] - $stats['user_growth']['last_month']) }}</span>
                    <span class="text-gray-500 ml-2">from last month</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Active Users Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Active Users</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['active_users'] }}</p>
                <div class="mt-2 flex items-center text-sm">
                    <span class="text-green-600 font-medium">{{ round(($stats['active_users'] / $stats['total_users']) * 100, 1) }}%</span>
                    <span class="text-gray-500 ml-2">activation rate</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Branches Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Branches</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_branches'] }}</p>
                <div class="mt-2 flex items-center text-sm">
                    <span class="text-blue-600 font-medium">{{ $stats['total_roles'] }}</span>
                    <span class="text-gray-500 ml-2">total roles</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- System Health Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">System Health</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['system_health']['uptime'] }}</p>
                <div class="mt-2 flex items-center text-sm">
                    <span class="text-green-600 font-medium">{{ $stats['system_health']['response_time'] }}</span>
                    <span class="text-gray-500 ml-2">response time</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Advanced Analytics Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- User Growth Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">User Growth Trend</h3>
            <p class="text-sm text-gray-600 mt-1">Monthly user registration and activation trends</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-2xl font-bold text-blue-900">{{ $stats['user_growth']['this_month'] }}</p>
                    <p class="text-sm text-blue-600">This Month</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-2xl font-bold text-green-900">{{ $stats['user_growth']['this_year'] }}</p>
                    <p class="text-sm text-green-600">This Year</p>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <p class="text-2xl font-bold text-purple-900">+{{ $stats['user_growth']['yoy_growth'] }}%</p>
                    <p class="text-sm text-purple-600">YoY Growth</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Distribution -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Role Distribution</h3>
            <p class="text-sm text-gray-600 mt-1">Users by system roles</p>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                @foreach($stats['role_distribution'] as $role)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-{{ $role['percentage'] > 20 ? 'green' : ($role['percentage'] > 10 ? 'yellow' : 'gray') }}-500 rounded-full mr-3"></span>
                            <span class="text-sm font-medium text-gray-900">{{ $role['name'] }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm font-bold text-gray-900">{{ $role['users_count'] }}</span>
                            <span class="text-sm text-gray-500 ml-2">({{ $role['percentage'] }}%)</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Branch Performance Overview -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Top Performing Branches -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Branch Performance</h3>
            <p class="text-sm text-gray-600 mt-1">Top performing branches by user activity</p>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($stats['branch_performance']->take(5) as $branch)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900">{{ $branch['name'] }}</p>
                            <p class="text-sm text-gray-600">{{ $branch['active_users'] }}/{{ $branch['users_count'] }} active</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-green-600">{{ $branch['performance_score'] }}%</p>
                            <p class="text-xs text-gray-500">Performance</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- System Health Metrics -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">System Health Metrics</h3>
            <p class="text-sm text-gray-600 mt-1">Real-time system performance indicators</p>
        </div>
        <div class="p-6 space-y-4">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                    <span class="text-sm font-medium text-gray-900">Database Status</span>
                </div>
                <span class="text-sm font-bold text-green-600">Healthy</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                    <span class="text-sm font-medium text-gray-900">API Gateway</span>
                </div>
                <span class="text-sm font-bold text-green-600">Operational</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></span>
                    <span class="text-sm font-medium text-gray-900">Storage Usage</span>
                </div>
                <span class="text-sm font-bold text-yellow-600">{{ $stats['system_health']['database_size'] }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                    <span class="text-sm font-medium text-gray-900">Last Backup</span>
                </div>
                <span class="text-sm font-bold text-gray-600">{{ $stats['system_health']['last_backup'] }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities & Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activities -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Recent System Activities</h3>
            <p class="text-sm text-gray-600 mt-1">Latest activities across all branches and modules</p>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($stats['recent_activities'] as $activity)
                    <div class="flex items-start space-x-3 p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200 border-l-4 border-{{ $activity->action == 'login' ? 'green' : ($activity->action == 'logout' ? 'red' : 'blue') }}-500">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-medium text-gray-600">
                                {{ $activity->user ? substr($activity->user->name, 0, 1) : 'S' }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-900">
                                    <span class="font-medium">{{ $activity->user ? $activity->user->name : 'System' }}</span>
                                    <span class="text-gray-600 ml-2">{{ $activity->description ?? $activity->action }}</span>
                                </p>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $activity->action == 'login' ? 'green' : ($activity->action == 'logout' ? 'red' : 'blue') }}-100 text-{{ $activity->action == 'login' ? 'green' : ($activity->action == 'logout' ? 'red' : 'blue') }}-800">
                                    {{ ucfirst($activity->action) }}
                                </span>
                            </div>
                            <div class="flex items-center mt-1 text-xs text-gray-500">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $activity->ip_address }}
                                <span class="mx-2">•</span>
                                {{ $activity->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-500 font-medium">No recent activities</p>
                        <p class="text-sm text-gray-400 mt-2">System activities will appear here once users start interacting with the system</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions & System Info -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('users.index') }}" class="block w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-900 group-hover:text-green-600">Manage Users</span>
                    </div>
                </a>
                <a href="{{ route('roles.index') }}" class="block w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-900 group-hover:text-green-600">Manage Roles</span>
                    </div>
                </a>
                <a href="{{ route('organization.branches.index') }}" class="block w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-900 group-hover:text-green-600">Manage Branches</span>
                    </div>
                </a>
                <a href="{{ route('dashboard.kpis') }}" class="block w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-900 group-hover:text-green-600">View KPIs</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- System Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">System Information</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Version</span>
                    <span class="text-sm font-medium text-gray-900">v2.1.0</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Environment</span>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Production</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Time Zone</span>
                    <span class="text-sm font-medium text-gray-900">{{ config('app.timezone', 'UTC') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Last Update</span>
                    <span class="text-sm font-medium text-gray-900">{{ now()->format('M j, Y') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">License</span>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Enterprise</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
