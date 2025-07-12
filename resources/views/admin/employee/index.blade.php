{{-- resources/views/admin/employee/index.blade.php --}}

@extends('layouts.app-admin')
@section('title', 'Data Karyawan')

@section('admin')
<div class="mt-3">
    <div class="flex justify-between items-center mb-8">
        <div class="text-xl font-medium">Data Karyawan</div>
        <a href="{{ route('admin.employee.create') }}" 
           class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            Tambah Karyawan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto relative">
        <table class="w-full text-sm text-left text-gray-500" id="employeeTable">
            <thead class="text-xs text-white uppercase bg-indigo-500">
                <tr class="divide-x divide-y">
                    <th scope="col" class="w-16 py-3 px-6">No</th>
                    <th scope="col" class="py-3 px-6">Nama</th>
                    <th scope="col" class="py-3 px-6">Email</th>
                    <th scope="col" class="py-3 px-6">Tanggal Dibuat</th>
                    <th scope="col" class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse ($employees as $employee)
                    <tr class="divide-x divide-y hover:bg-gray-50">
                        <td class="w-16 py-3 px-6">{{ $loop->iteration + ($employees->currentPage() - 1) * $employees->perPage() }}</td>
                        <td class="py-3 px-6">{{ $employee->name }}</td>
                        <td class="py-3 px-6">{{ $employee->email }}</td>
                        <td class="py-3 px-6">{{ $employee->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3 px-6">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.employee.edit', $employee->id) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.employee.destroy', $employee->id) }}" 
                                      method="POST" class="inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            Belum ada data karyawan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($employees->hasPages())
            <div class="mt-4">
                {{ $employees->links() }}
            </div>
        @endif
    </div>
</div>
@endsection