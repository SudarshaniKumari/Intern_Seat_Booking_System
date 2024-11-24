<!-- resources/views/user/fill-training-id.blade.php -->
<form action="{{ route('user.updateTrainingId') }}" method="POST">
    @csrf
    <label for="training_id">Training ID:</label>
    <input type="text" name="training_id" id="training_id" value="{{ old('training_id', auth()->user()->training_id) }}" required>
    <button type="submit">Submit</button>
</form>
