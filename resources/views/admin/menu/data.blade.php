{{ $publications->links('components.paginator') }}

@php
$class_head_tr = 'sticky z-10 top-10 text-xs leading-6 font-semibold text-white bg-sky-600 p-3 border border-collapse';
$class_body_tr = 'py-3 pl-2 pr-2 font-mono text-xs leading-6 bg-white text-gray-900 border
border-collapse';

@endphp
<div class="grid gap-4 md:grid-cols-1 print:grid-cols-1 rounded-lg mt-3 px-1">
    <table class="w-full">
        <thead>
            <tr class="text-center">
                <th class="{{ $class_head_tr }}">Id</th>
                <th class="{{ $class_head_tr }}">Title</th>
                <th class="{{ $class_head_tr }}">Type</th>
                <th class="{{ $class_head_tr }}">Year</th>
                <th class="{{ $class_head_tr }}">Writer</th>
                <th class="{{ $class_head_tr }}">Link</th>
                <th class="{{ $class_head_tr }}">Pdf</th>
                <th class="{{ $class_head_tr }}">Status</th>
                <th class="{{ $class_head_tr }}">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($publications as $key => $publication)
            <tr class="text-center">
                <td class="{{ $class_body_tr }}">{{ $publication->id ?? ''}}</td>
                <td class="{{ $class_body_tr }}">{{ $publication->title ?? ''}}</td>
                <td class="{{ $class_body_tr }}">{{ $publication->type == 1 ? 'Journal' : 'Conference'}}</td>
                <td class="{{ $class_body_tr }}">{{ $publication->year ?? ''}}</td>
                <td class="{{ $class_body_tr }}">{{ $publication->writer ?? ''}}</td>
                <td class="{{ $class_body_tr }}">
                    @if($publication->link ?? '')
                    <a href="{{ $publication->link ?? '#'}}" target="_blank" rel="noopener noreferrer" class="px-3 py-1 bg-green-500 hover:bg-green-400 text-white rounded">
                        Link
                    </a>
                    @else
                        <span class="text-rose-600">Empty</span>
                    @endif
                </td>
                <td class="{{ $class_body_tr }}">
                    @if($publication->file ?? '')
                    <a href="{{ isset($publication->file) ? asset($publication->file): '#'}}" target="_blank" rel="noopener noreferrer" class="px-3 py-1 bg-orange-500 hover:bg-orange-400 text-white rounded">
                        Pdf
                    </a>
                    @else
                        <span class="text-rose-600">Empty</span>
                    @endif
                </td>
                <td class="{{ $class_body_tr }}">{{ $publication->status == 1 ? 'Actice':'InActive'}}</td>
            
                <td class="{{ $class_body_tr }}">
                    <div class="flex justify-between gap-1">
                        <a href="{{ route('manage-publications.edit', $publication->id) }}"
                            class="edit_publication px-3 py-1 rounded bg-sky-500 hover:bg-blue-400 text-white">
                            Edit
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<hr class="my-2 print:hidden">

{{ $publications->links('components.paginator') }}