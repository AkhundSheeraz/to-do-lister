<x-layout title="groups">
    <button id="add_group">Add-Group</button>
    <div id="group_div">
        <ul id="group_ul">
            <li>No groups to display!</li>
        </ul>
    </div>

    <x-modal heading="Add a Group">
        <input class="modal_inp" type="text" name="group_type" placeholder="Enter Group Name..">
        <button class="modal_btn" type="submit">Add</button>
    </x-modal>
</x-layout>
