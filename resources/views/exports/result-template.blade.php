<table>
    <thead>
    <tr>
        <th>Fullname</th>
        <th>Reg No</th>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Session</th>
        <th>School</th>
        <th>Score</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($students as $index => $student)
    <tr>
        <td>{{ $student->fullname }}</td>
        <td>{{ $student->reg_no }}</td>
        <td>{{ $student->id }}</td>
        <td>{{ $course_id }}</td>
        <td>{{ $student->session->session }}</td>
        <td>{{ $student->school }}</td>
        <td>0</td>
    </tr>
    @endforeach
    </tbody>
</table>