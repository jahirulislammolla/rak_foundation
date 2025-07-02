{{ $teachings->links('components.paginator') }}

@php
$class_head_tr = 'sticky z-10 top-10 text-xs leading-6 font-semibold text-white bg-sky-600 p-3 border border-collapse';
$class_body_tr = 'py-3 pl-2 pr-2 font-mono text-xs leading-6 bg-white text-gray-900 border
border-collapse';
$types = [
    1 => "Assistant Professor",
    2 => "Lecturer",
    3 => "Teaching Assistant",
    4 => "Course Instructor / Sessional Lecturer",
    5 => "Guest Lectures",
];
@endphp
<div class="grid gap-4 md:grid-cols-1 print:grid-cols-1 rounded-lg mt-3 px-1">
    <table class="w-full">
        <thead>
            <tr class="text-center">
                <th class="{{ $class_head_tr }}">Id</th>
                <th class="{{ $class_head_tr }}">Title</th>
                <th class="{{ $class_head_tr }}">Type</th>
                <th class="{{ $class_head_tr }}">Content</th>
                <th class="{{ $class_head_tr }}">Priority</th>
                <th class="{{ $class_head_tr }}">Status</th>
                <th class="{{ $class_head_tr }}">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachings as $key => $teaching)
            <tr class="text-center">
                <td class="{{ $class_body_tr }}">{{ $teaching->id ?? ''}}</td>
                <td class="{{ $class_body_tr }}">{{ $teaching->title ?? ''}}</td>
                <td class="{{ $class_body_tr }}">{{ $types[$teaching->type] ?? ''}}</td>
                <td class="{{ $class_body_tr }} text-left">{!! $teaching->content ?? '' !!}</td>
                <td class="{{ $class_body_tr }}">{{ $teaching->priority ?? ''}}</td>
                <td class="{{ $class_body_tr }}">{{ $teaching->status == 1 ? 'Actice':'InActive'}}</td>
                <td class="{{ $class_body_tr }}">
                    <div class="flex justify-between gap-1">
                        <a href="{{ route('manage-teachings.edit', $teaching->id) }}"
                            class="edit_teaching px-3 py-1 rounded bg-sky-500 hover:bg-blue-400 text-white">
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

{{ $teachings->links('components.paginator') }}