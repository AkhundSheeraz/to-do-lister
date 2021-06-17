<x-layout title="checklist">
    <button id="add_btn">Add-Checklist</button>
    <div>
        {{-- <ul id="checklistings">
            @if (isset($checklists))
                @foreach ($checklists as $checklist)
                    <li><a href="{{Route('view_list',$checklist->id)}}">{{ ucfirst($checklist->checklist_name) }}</li></a>
                @endforeach
            @else
            <li id="null_lists">You Have no checklists</li>
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
            <tbody id="checklists_table">
                @if (isset($checklists))
                    @foreach ($checklists as $checklist)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $checklist->checklist_name }}</td>
                        <td>{{ $checklist->created_at }}</td>
                    </tr>
                    @endforeach
                @else
                <tr id="null_lists">
                    <td>empty</td>
                    <td>empty</td>
                    <td>empty</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-modal heading="Add a Checklist">
        <form id="checklist_form">
            <input class="modal_inp" id="check_inp" type="text" name="checklist" placeholder="Enter checklist name..">
            <select class="modal_inp mt-3" id="check_opts" name="group_id">
                <option class="opt" id="check_defualt" value="">Select-group</option>
                @if (isset($groups))
                    @foreach ($groups as $group)
                        <option class="opt" value="{{ $group->id }}">{{ $group->type }}</option>
                    @endforeach
                @else
                    <option class="opt" value="">No-groups available</option>
                @endif
            </select>
            <p class="cmsg"></p>
            <button class="modal_btn" type="submit">Add</button>
        </form>
    </x-modal>
</x-layout>
