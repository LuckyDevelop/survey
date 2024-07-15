<!DOCTYPE html>
<html>

<head>
    <title>Word Document Preview</title>
</head>

<body>
    <iframe src="{{ $googleDocsViewerUrl }}" width="100%" height="600px">
        This browser does not support embedded documents. Please download the document to view it: <a
            href="{{ $googleDocsViewerUrl }}">Download Document</a>
    </iframe>
</body>

</html>
