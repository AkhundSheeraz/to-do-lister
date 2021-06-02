<x-layout title="groups">
    <button id="add_group">Add-Group</button>
    <div id="group_div">
        <ul id="group_ul">
            @if (isset($groups))
                @foreach ($groups as $group)
                    <li><a href="#">{{ $group->type }}</a></li>
                @endforeach
            @else
                <li id="null_groups">No groups to display!</li>
            @endif
        </ul>
    </div>

    <x-modal heading="Add a Group">
        <form id="group_form">
            <input class="modal_inp" id="grp_inp" type="text" name="group_type" placeholder="Enter group name..">
            <p id="msg"></p>
            <button class="modal_btn" type="submit">Add</button>
        </form>
    </x-modal>
</x-layout>
