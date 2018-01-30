<form method="post" class="form-horizontal">
    {{ csrf_field() }}
    <div class="box-body">
        @if (in_array($content->type, ['education-nutrition', 'education-workout', 'education-training']) || (isset($type) && $type === 'education'))
        <div class="form-group">
            <label for="type" class="col-sm-2 control-label">Type</label>
            <div class="col-sm-10">
                <label><input name="type" type="radio" class="square-green" value="education-nutrition" @if ($content->type === 'education-nutrition') checked @endif > Nutrition</label>
                <label><input name="type" type="radio" class="square-green" value="education-training" @if ($content->type === 'education-training') checked @endif > Training</label>
                <label><input name="type" type="radio" class="square-green" value="education-workout" @if ($content->type === 'education-workout') checked @endif > Workouts</label>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input name="title" type="text" class="form-control" value="{{ $content->title }}">
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-sm-2 control-label">Content</label>
            <div class="col-sm-10">
                <textarea name="content" type="text" class="textarea form-control" rows="10">{{ $content->content }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="source" class="col-sm-2 control-label">Source/Link</label>
            <div class="col-sm-10">
                <input name="source" type="text" class="form-control" value="{{ $content->source }}">
            </div>
        </div>
        <div class="form-group">
            <label for="source_type" class="col-sm-2 control-label">Source Type</label>
            <div class="col-sm-10">
                <label><input name="source_type" type="radio" class="square-green" value="video" @if ($content->source_type === 'video') checked @endif > Video</label>
                <label><input name="source_type" type="radio" class="square-green" value="image" @if ($content->source_type === 'image') checked @endif > Image</label>
            </div>
        </div>
        <div class="form-group">
            <label for="preview" class="col-sm-2 control-label">Preview Image</label>
            <div class="col-sm-10">
                <input name="preview" type="text" class="form-control" value="{{ $content->preview }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <label><input type="checkbox" name="published" value="1" class="square-green" @if ($content->published) checked @endif> Published</label>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a class="btn btn-default" href="{{ $redirect }}">Cancel</a>
        <button type="submit" class="btn btn-info pull-right">Save</button>
    </div>
</form>