<x-layout>
    <div>
        <table class="table table-hover text-center table_size">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Add Friend</th>
                </tr>
            </thead>
            <tbody id="friends">
                @if ($friends->isNotEmpty())
                @foreach ($friends as $friend)
                    <tr data-id="{{$friend->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$friend->firstname .' '. $friend->lastname}}</td>
                        <td>{{$friend->email}}</td>
                        <td><button class="btn btn-outline-primary dost">Add</button></td>
                    </tr>
                @endforeach
                @else
                <tr id="null_friends">
                    <td>empty</td>
                    <td>empty</td>
                    <td>empty</td>
                    <td>empty</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</x-layout>
