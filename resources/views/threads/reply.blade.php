<reply :attributes="{{$reply}}" inline-template v-cloak>
    <div>

        <div id="reply-{{$reply->id}}" class="card-header">
            <div class="level">

                <h6 class="flex">
                    <a href={{route('profile', $reply->owner->name)}}>{{$reply->owner->name}}</a>
                    said {{$reply->created_at->diffForHumans()}}...
                </h6>

                <div>
                    <favorite :reply="{{$reply}}"></favorite>
                </div>

            </div>
        </div>

        <div class="card-body">

            <div v-if="editing">

                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-xs btn-primary" v-on:click="update()">Update</button>
                <button class="btn btn-xs btn-link" v-on:click="cancel()">Cancel</button>

            </div>

            <div v-else v-text="body"></div>

        </div>

        @can('update', $reply)

            <div class="level">

                <button class="btn btn-dark btn-xs mr-1" v-on:click="editing = true">Edit</button>
                <button class="btn btn-xs btn-danger mr-1" v-on:click="destroy">Delete</button>

            </div>

        @endcan

    </div>
</reply>
