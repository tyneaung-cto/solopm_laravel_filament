

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Task Updated</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f6f6f6; padding:20px;">

    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:auto;background:#ffffff;border-radius:8px;padding:20px;">
        <tr>
            <td>
                <h2 style="margin-top:0;">Task Updated</h2>

                <p>Hello,</p>

                <p>A task has been updated in the system.</p>

                <hr style="border:none;border-top:1px solid #eee;margin:20px 0;">

                <p><strong>Title:</strong> {{ $task->title ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $task->status ?? 'N/A' }}</p>
                <p><strong>Priority:</strong> {{ $task->priority ?? 'N/A' }}</p>
                <p><strong>Due Date:</strong> {{ $task->due_date ?? 'N/A' }}</p>

                @if(!empty($task->description))
                    <p><strong>Description:</strong></p>
                    <div>{!! $task->description !!}</div>
                @endif

                <hr style="border:none;border-top:1px solid #eee;margin:20px 0;">

                <p style="font-size:14px;color:#777;">
                    This email was automatically sent by SoloPM.
                </p>
            </td>
        </tr>
    </table>

</body>
</html>