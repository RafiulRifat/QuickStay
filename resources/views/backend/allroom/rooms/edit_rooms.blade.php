@extends('admin.admin_dashboard')

@section('admin') 

<div class="container">
    <h2>Edit Room</h2>

    <form action="{{ route('update.room', $editData->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Room Details -->
        <div class="form-group">
            <label>Room Type</label>
            <select name="roomtype_id" class="form-control">
                <option value="1" {{ $editData->roomtype_id == 1 ? 'selected' : '' }}>Single Room</option>
                <option value="2" {{ $editData->roomtype_id == 2 ? 'selected' : '' }}>Double Room</option>
            </select>
        </div>

        <div class="form-group">
            <label>Total Adult</label>
            <input type="number" name="total_adult" class="form-control" value="{{ $editData->total_adult }}">
        </div>

        <div class="form-group">
            <label>Total Child</label>
            <input type="number" name="total_child" class="form-control" value="{{ $editData->total_child }}">
        </div>

        <div class="form-group">
            <label>Room Capacity</label>
            <input type="number" name="room_capacity" class="form-control" value="{{ $editData->room_capacity }}">
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="{{ $editData->price }}">
        </div>

        <div class="form-group">
            <label>Short Description</label>
            <textarea name="short_desc" class="form-control">{{ $editData->short_desc }}</textarea>
        </div>

        <div class="form-group">
            <label>Full Description</label>
            <textarea name="description" class="form-control">{{ $editData->description }}</textarea>
        </div>

        <!-- Room Main Image -->
        <div class="form-group">
            <label>Main Image</label>
            <input type="file" name="image" class="form-control">

            @if(!empty($editData->image)) 
                <img src="{{ asset('upload/roomimg/' . $editData->image) }}" width="120">
            @endif
        </div>

        <!-- Room Facilities -->
        <div class="form-group">
            <label>Facilities</label>
            @php
                $facilities = is_array($editData->facilities) ? $editData->facilities : explode(',', $editData->facilities ?? '');
            @endphp
            <select name="facility_name[]" class="form-control" multiple>
                <option value="Complimentary Breakfast" {{ in_array('Complimentary Breakfast', $facilities) ? 'selected' : '' }}>Complimentary Breakfast</option>
                <option value="32/42 inch LED TV" {{ in_array('32/42 inch LED TV', $facilities) ? 'selected' : '' }}>32/42 inch LED TV</option>
                <option value="Smoke alarms" {{ in_array('Smoke alarms', $facilities) ? 'selected' : '' }}>Smoke alarms</option>
                <option value="Minibar" {{ in_array('Minibar', $facilities) ? 'selected' : '' }}>Minibar</option>
                <option value="Free Wi-Fi" {{ in_array('Free Wi-Fi', $facilities) ? 'selected' : '' }}>Free Wi-Fi</option>
                <option value="Safety Box" {{ in_array('Safety Box', $facilities) ? 'selected' : '' }}>Safety Box</option>
            </select>
        </div>

        <!-- Multi-Image Upload Preview -->
        <div class="form-group">
            <label>Room Images</label>
            <input type="file" name="multi_img[]" class="form-control" multiple id="multiImg">
            <div id="preview_img">
                @foreach($editData->multi_images as $img)
                    <img src="{{ asset('upload/roomimg/multi_img/' . $img) }}" width="100" height="80">
                @endforeach
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Room</button>

    </form>
</div>

<!-- Script to Preview Multi-Images -->
<script>
    $(document).ready(function(){
        $('#multiImg').on('change', function(){
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var data = $(this)[0].files;
                $('#preview_img').html('');

                $.each(data, function(index, file){
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
                        var fRead = new FileReader();
                        fRead.onload = (function(file){
                            return function(e) {
                                var img = $('<img/>').addClass('thumb')
                                    .attr('src', e.target.result)
                                    .width(100)
                                    .height(80);
                                $('#preview_img').append(img);
                            };
                        })(file);
                        fRead.readAsDataURL(file);
                    }
                });
            } else {
                alert("Your browser doesn't support File API!");
            }
        });
    });
</script>

@endsection
