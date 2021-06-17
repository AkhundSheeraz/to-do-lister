<x-layout title="groups">
    <button id="add_btn">Add-Group</button>
    <div id="group_div">
        {{-- <ul id="group_ul">
            @if (isset($groups))
                @foreach ($groups as $group)
                    <li><a href="#">{{ ucfirst($group->type) }}</a></li>
                @endforeach
            @else
                <li id="null_groups">No groups to display!</li>
            @endif
        </ul> --}}
        <table class="table text-center table_size">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody id="group_table_body">
                @if (isset($groups))
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst($group->type) }}</td>
                            <td>{{ $group->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr id="null_groups">
                        <td>empty</td>
                        <td>empty</td>
                        <td>empty</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-modal heading="Add a Group">
        <form id="group_form">
            <input class="modal_inp" id="grp_inp" type="text" name="group_type" placeholder="Enter group name..">
            <p id="msg"></p>
            <button class="modal_btn" type="submit">Add</button>
        </form>
    </x-modal>
</x-layout>
