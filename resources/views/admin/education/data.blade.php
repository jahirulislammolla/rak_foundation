{{ $educations->links('components.paginator') }}

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
                <th class="{{ $class_head_tr }}">Content</th>
                <th class="{{ $class_head_tr }}">Priority</th>
                <th class="{{ $class_head_tr }}">Status</th>
                <th class="{{ $class_head_tr }}">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($educations as $key => $education)
            <tr class="text-center">
                <td class="{{ $class_body_tr }}">{{ $education->id ?? ''}}</td>
                <td class="{{ $class_body_tr }}">{{ $education->title ?? ''}}</td>
                <td class="{{ $class_body_tr }} text-start">{!! $education->content ?? '' !!}</td>
                <td class="{{ $class_body_tr }}">{{ $education->priority ?? ''}}</td>
                <td class="{{ $class_body_tr }}">{{ $education->status == 1 ? 'Actice':'InActive'}}</td>
                <td class="{{ $class_body_tr }}">
                    <div class="flex justify-between gap-1">
                        <a href="{{ route('manage-educations.edit', $education->id) }}"
                            class="edit_education px-3 py-1 rounded bg-sky-500 hover:bg-blue-400 text-white">
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

{{ $educations->links('components.paginator') }}