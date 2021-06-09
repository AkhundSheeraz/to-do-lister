<x-layout title="view_checklist">
    <button id="add_btn">Add-Items</button>
    {{-- <ul id="inside_list" data-id="{{ $id }}">
        @if (isset($fetching))
            @foreach ($fetching as $item)
            <li>{{ ucfirst($item->item_name) }}</li>                
            @endforeach
        @else
        <li id="null_item">You have no tasks/items in this list</li>
        @endif
    </ul> --}}
    <table id="chk_table" class="table" data-id="{{ $id }}">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Added</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="tablebody">
            @if (isset($fetching))
                @foreach ($fetching as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>nil</td>
                    </tr>
                @endforeach
            @else
                <tr id="null_items">
                    <td>empty</td>
                    <td>empty</td>
                    <td>empty</td>
                    <td>empty</td>
                </tr>
            @endif
        </tbody>
    </table>
    <x-modal heading="Add Item/Task to this Checklist">
        <form id="add_task_item">
            <input class="modal_inp" id="taskiteminp" type="text" name="task_item" placeholder="task or item">
            <p class="m-1 cmsg" id="ierr"></p>
            <button class="modal_btn" type="submit">Add</button>
        </form>
    </x-modal>
</x-layout>
