<x-layout title="checklist">
    <button id="add_btn">Add-Checklist</button>
    <div>
        <ul id="checklistings">
            <li>You Have no checklists</li>
        </ul>
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
            <button class="modal_btn" type="submit">Add</button>
        </form>
    </x-modal>
</x-layout>
