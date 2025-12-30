@extends('layouts.app')

@section('content')

    <h2>Edit Employee</h2>

    <form method="POST" action="{{ route('employees.update', $employee) }}">
        @csrf
        @method('PUT')

        <label>First Name</label><br>
        <input name="first_name" value="{{ $employee->first_name }}"><br><br>

        <label>Last Name</label><br>
        <input name="last_name" value="{{ $employee->last_name }}"><br><br>

        <input name="email" id="email" value="{{ $employee->email }}">
        <div id="emailError" style="color:red; display:none;">
            Email already exists!
        </div>
        <br><br>

        <label>Department</label><br>
        <select name="department_id">
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}"
                        {{ $employee->department_id == $dept->id ? 'selected' : '' }}>
                    {{ $dept->name }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Select Skill</label><br>
        <select id="skillDropdown">
            <option value="">-- Select Skill --</option>
            @foreach($skills as $skill)
                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Selected Skills</label><br>
        <div id="selectedSkills">
            @foreach($employee->skills as $skill)
                <div class="skill-tag">
                    {{ $skill->name }}
                    <input type="hidden" name="skills[]" value="{{ $skill->id }}">
                    <span class="remove-skill">✕</span>
                </div>
            @endforeach
        </div>

        <br>
        <button type="submit" id="employeeSubmitBtn">Update</button>

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

                // Reset dropdown to allow same skill again
                $(this).val('');
            });

            $(document).on('click', '.remove-skill', function () {
                $(this).parent('.skill-tag').remove();
            });

        });


        let originalEmail = "{{ strtolower(trim($employee->email)) }}";

        $('#email').on('blur', function () {
            let email = $(this).val().trim().toLowerCase();

            if (!email || email === originalEmail) {
                $('#emailError').hide();
                $('#employeeSubmitBtn').prop('disabled', false);
                return;
            }

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
