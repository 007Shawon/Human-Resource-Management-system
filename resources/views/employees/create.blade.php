@extends('layouts.app')

@section('content')

    <h2>Create Employee</h2>

    <form method="POST" action="{{ route('employees.store') }}">
        @csrf

        <label>First Name</label><br>
        <input name="first_name"><br><br>

        <label>Last Name</label><br>
        <input name="last_name"><br><br>

        <label>Email</label><br>
        <input name="email" id="email">
        <div id="emailError" style="color:red; display:none;">
            Email already exists!
        </div>
        <br><br>


        <label>Department</label><br>
        <select name="department_id">
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
            @endforeach
        </select><br><br>

        <label>Select Skill</label><br>
        <select id="skillDropdown">
            <option value="">-- Select Skill --</option>
            @foreach($skills as $skill)
                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Selected Skills</label><br>
        <div id="selectedSkills"></div>

        <br>
        <button type="submit" id="employeeSubmitBtn">Save</button>

    </form>

    <style>
        .skill-tag {
            display: inline-block;
            padding: 5px 8px;
            margin: 4px;
            background: #e5e7eb;
            border-radius: 4px;
            position: relative;
        }

        .skill-tag span {
            cursor: pointer;
            color: red;
            margin-left: 8px;
            font-weight: bold;
        }
    </style>

    <script>
        $(document).ready(function () {

            $('#skillDropdown').change(function () {
                let skillId = $(this).val();
                let skillText = $(this).find('option:selected').text();

                if (!skillId) return;

                let tag = `
            <div class="skill-tag">
                ${skillText}
                <input type="hidden" name="skills[]" value="${skillId}">
                <span class="remove-skill">✕</span>
            </div>
        `;
                $('#selectedSkills').append(tag);

                // reset dropdown so same skill can be selected again
                $(this).val('');
            });

            $(document).on('click', '.remove-skill', function () {
                $(this).parent('.skill-tag').remove();
            });

        });


        $('#email').blur(function () {
            let email = $(this).val();

            if (!email) return;

            $.get('/check-email', {email: email}, function (exists) {
                if (exists) {
                    $('#emailError').show();
                    $('#employeeSubmitBtn').prop('disabled', true);
                } else {
                    $('#emailError').hide();
                    $('#employeeSubmitBtn').prop('disabled', false);
                }
            });
        });
    </script>

@endsection
