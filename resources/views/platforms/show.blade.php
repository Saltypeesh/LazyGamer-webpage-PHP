<x-layout>
    <div class="space d-md-none"></div>
        <div class="container">
            <div class="mt-3">
            </div>
            <div class="headline">
                <h2>Platform:</h2>
            </div>

            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="platname">Name: {{ $platform->platname }}</span>
                </div>
                <div class="col-6 col-end-4">
                    <a href="{{url('admin/platforms/'.$platform->id.'/edit')}}"><button class="btn btn-primary">Edit</button></a>
                    <form method="POST" action={{ url('admin/platforms/' . $platform->id) }} style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Platform" onclick="return confirm("Confirm delete?")"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </form>
                    <a href="/admin/platforms/edit"><button class="btn btn-primary"></button></a>
                </div>
            </div>
        </div>
    </section>
</x-layout>