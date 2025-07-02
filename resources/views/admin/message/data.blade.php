{{ $messages->links('components.paginator') }}

@php
$class_head_tr = 'sticky z-10 top-10 text-xs leading-6 font-semibold text-white bg-sky-600 p-3 border border-collapse';
$class_body_tr = 'py-3 pl-2 pr-2 font-mono text-xs leading-6 bg-white text-gray-900 border border-collapse';
@endphp

<div class="grid gap-4 md:grid-cols-1 print:grid-cols-1 rounded-lg mt-3 px-1">
    <table class="w-full">
        <thead class="">
            <tr class="text-center">
                <th class="{{ $class_head_tr }}">Name</th>
                <th class="{{ $class_head_tr }}">Email</th>
                <th class="{{ $class_head_tr }}">Subject</th>
                <th class="{{ $class_head_tr }}">Message</th>
                <th class="{{ $class_head_tr }}">Date</th>
                <th class="{{ $class_head_tr }}">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
            <tr class="text-center">
                <td class="{{ $class_body_tr }}">{{ $message->fullname }}</td>
                <td class="{{ $class_body_tr }}">{{ $message->email }}</td>
                <td class="{{ $class_body_tr }}">{{ $message->subject }}</td>
                <td class="{{ $class_body_tr }}">{{ $message->message }}</td>
                <td class="{{ $class_body_tr }}">{{ $message->created_at->format('d M Y') }}</td>
                <td class="{{ $class_body_tr }}">
                    <div class="flex justify-center gap-1">
                        <form action="{{ route('message.delete', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="edit_message px-3 py-1 rounded bg-rose-500 hover:bg-rose-400 text-white">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<hr class="my-2 print:hidden">

{{ $messages->links('components.paginator') }}
