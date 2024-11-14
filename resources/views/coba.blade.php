<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="row">
    <multi-input>
        <input list="speakers">
        <datalist id="speakers">
          <option value="Banquo"></option>
          <option value="Celia"></option>
          ...
        </datalist>
      </multi-input>
    </div>
    <script src="{{ asset('js/multiple-input.js') }}"></script>
</body>
</html>
