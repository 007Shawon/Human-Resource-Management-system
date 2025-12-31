@extends('layouts.app')

@section('content')

    <div class="form-container">
        <h2>Create Employee</h2>

        <form method="POST" action="{{ route('employees.store') }}">
            @csrf

            <div class="form-group">
                <label>First Name</label>
                <input name="first_name" class="form-input">
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input name="last_name" class="form-input">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input name="email" id="email" class="form-input">
                <div id="emailError" class="error-text">Email already exists!</div>
            </div>

            <div class="form-group">
                <label>Department</label>
                <select name="department_id" class="form-select">
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Select Skill</label>
                <select id="skillDropdown" class="form-select">
                    <option value="">-- Select Skill --</option>
                    @foreach($skills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Selected Skills</label>
                <div id="selectedSkills" class="skills-container"></div>
            </div>

            <button type="submit" id="employeeSubmitBtn" class="btn-submit">Save</button>
        </form>
    </div>

    <style>
        .form-container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #374151;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.3s;
        }

        .form-input:focus, .form-select:focus {
            border-color: #4f46e5;
            outline: none;
        }

        .error-text {
            color: red;
            display: none;
            font-size: 13px;
            margin-top: 4px;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .skill-tag {
            display: inline-flex;
            align-items: center;
            background: #e0e7ff;
            color: #3730a3;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 13px;
        }

        .skill-tag span {
            cursor: pointer;
            margin-left: 6px;
            font-weight: bold;
            color: #ef4444;
        }

        .btn-submit {
            width: 100%;
            padding: 10px 0;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #4338ca;
        }
    </style>

    <script>
        $(document).ready(function () {

            // Add skill dynamically
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
                $(this).val('');
            });

            // Remove skill dynamically
            $(document).on('click', '.remove-skill', function () {
                $(this).parent('.skill-tag').remove();
            });

            // AJAX email uniqueness check
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
        });
    </script>

@endsection
