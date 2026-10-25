<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Updated</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, sans-serif; color:#333333;">

  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f8; padding:40px 20px;">
    <tr>
      <td align="center">

        <table width="600" cellpadding="0" cellspacing="0" border="0"
          style="max-width:600px; width:100%; background:#ffffff; border-radius:8px; overflow:hidden;">

          <!-- Header -->
          <tr>
            <td style="background:#2563eb; padding:25px; text-align:center;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1HE51g1QFrOdlhF0eLqVjsYNknuh_bIdCYqjAj1sg3g&s=10" style="width: 50px;margin-bottom:10px;border-radius:50%;" alt="">
              <h1 style="margin:0; color:#ffffff; font-size:24px;">
                Profile Updated
              </h1>
            </td>
          </tr>

          <!-- Content -->
          <tr>
            <td style="padding:40px 35px;">
              <p style="margin:0 0 20px; font-size:16px;">
                Hi <strong>{{ $user->name }}</strong>,
              </p>

              <p style="margin:0 0 20px; font-size:16px; line-height:1.6;">
                Your profile information has been successfully updated.
              </p>

              <div style="background:#f8fafc; border-left:4px solid #2563eb; padding:15px 20px; margin:25px 0;">
                <p style="margin:0 0 8px; font-size:14px; color:#666666;">
                  Name : <b>{{$user->name}}</b>
                </p>
                <p style="margin:0 0 8px; font-size:14px; color:#666666;">
                  Email : <b>{{$user->email}}</b>
                </p>
                <p style="margin:0 0 8px; font-size:14px; color:#666666;">
                  Role : <b>{{$user->role}}</b>
                </p>
                <p style="margin:0 0 8px; font-size:14px; color:#666666;">
                  Updated on : <b>{{$user->updated}}</b>
                </p>
              </div>

              <p style="margin:0 0 25px; font-size:15px; line-height:1.6;">
                If you made this change, no further action is required.
                If you didn't update your profile, please secure your account
                immediately.
              </p>

              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="background:#2563eb; border-radius:6px;">
                    <a href="{{ route('users.show',['user' => $user->id]) }}" target="_blank"
                    {{-- <a href="http://lara-project.test/users/{{ $user->id }}" target="_blank" --}}
                       style="display:inline-block; padding:13px 24px; color:#ffffff;
                              text-decoration:none; font-size:15px; font-weight:bold;">
                      View My Profile
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#f8fafc; padding:20px 35px; text-align:center;">
              <p style="margin:0 0 8px; font-size:13px; color:#777777;">
                This is an automated message. Please do not reply to this email.
              </p>

              <p style="margin:0; font-size:12px; color:#999999;">
                &copy; year company_name. All rights reserved.
              </p>
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

</body>
</html>
