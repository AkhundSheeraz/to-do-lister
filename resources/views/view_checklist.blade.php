<x-layout title="view_checklist">
    <button id="add_btn">Add-Items</button>
    <table id="chk_table" class="table" data-id="{{ $id }}">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Name</th>
                <th>Added</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="tablebody">
            @if (isset($fetching))
                @foreach ($fetching as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @if ($item->status == 0)
                            <div class="off_on" data-id="{{ $item->id }}">
                                <i class="far fa-times-circle cross"></i>
                            </div>
                            @else
                                <div class="off_on" data-id="{{ $item->id }}">
                                    <i class="far fa-check-circle checkmark"></i>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center" id="null_items">
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
