
Something went wrong connecting to the database...
@if(isset($exception))
Details: {{$exception->getMessage()}}
@endif