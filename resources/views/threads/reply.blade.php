<reply :attributes="{{$reply}}" inline-template v-cloak>
    <div>

        <div id="reply-{{$reply->id}}" class="card-header">
            <div class="level">

                <h6 class="flex">
                    <a href={{route('profile', $reply->owner->name)}}>{{$reply->owner->name}}</a>
                    said {{$reply->created_at->diffForHumans()}}...
                </h6>

                <div>
                    <form method="POST" action="/replies/{{$reply->id}}/favorites">
                        {{csrf_field()}}

                        <button type="submit" class="btn btn-default" {{$reply->isFavorited()? 'disabled' : ''}}>
                            {{$reply->favorites_count}} {{str_plural('Favorite', $reply->favorites_count)}}
                        </button>
                    </form>
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

                <form method="POST" action="/replies/{{$reply->id}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}

                    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                </form>

            </div>

        @endcan

    </div>
</reply>
