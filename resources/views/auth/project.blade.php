<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Administrator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
<form action="{{route('showUserProject')}}">
    <select name = "choseUser[]" class="js-select2" multiple="multiple">
        <option value="1">Alabama</option>
        <option value="2">Wyoming</option>
        <option value="3">ahihi</option>

    </select>
    <select name = "chosePosition" class="js-select2" multiple="multiple">
        <option value="1">DEV</option>
        <option value="2">PM</option>
        <option value="3">Test</option>
        <option value="4">Other</option>
    </select>
    <input type="submit" name="ahihi" value="submittt">
</form>
<script type="application/javascript">
    $(document).ready(function() {
        $('.js-select2').select2();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>


