<!DOCTYPE html>
<html lang="id" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Kata Sandi – Sistem Inventaris BPMP Malut</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            outline: none;
            text-decoration: none;
        }

        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #0a0f1d;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            background-color: #0a0f1d;
            padding: 48px 16px;
        }

        .email-container {
            max-width: 560px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
        }

        .logo-title {
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .logo-subtitle {
            color: #475569;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        /* Card */
        .card {
            background-color: #111827;
            border-radius: 24px;
            border: 1px solid #1e293b;
            overflow: hidden;
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.5);
        }

        /* Card Top Accent */
        .card-accent {
            height: 4px;
            background: linear-gradient(90deg, #1d4ed8, #2563eb, #3b82f6, #60a5fa);
        }

        .card-body {
            padding: 40px 40px 36px;
        }

        /* Icon section */
        .icon-section {
            text-align: center;
            margin-bottom: 28px;
        }

        .key-icon-wrap {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(37, 99, 235, 0.05));
            border: 1px solid rgba(37, 99, 235, 0.3);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .card-title {
            color: #f1f5f9;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.4px;
            margin-bottom: 8px;
        }

        .card-lead {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #1e293b;
            margin: 28px 0;
        }

        /* Greeting */
        .greeting {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .greeting strong {
            color: #e2e8f0;
            font-weight: 600;
        }

        /* CTA Button */
        .btn-wrap {
            text-align: center;
            margin: 28px 0;
        }

        .btn-reset {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 14px 36px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
            text-transform: uppercase;
        }

        /* Info box */
        .info-box {
            background-color: rgba(30, 41, 59, 0.6);
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
        }

        .info-box-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
        }

        .info-box-row:last-child {
            margin-bottom: 0;
        }

        .info-dot {
            width: 6px;
            height: 6px;
            background-color: #2563eb;
            border-radius: 50%;
            margin-top: 6px;
            flex-shrink: 0;
        }

        .info-text {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .info-text strong {
            color: #94a3b8;
        }

        /* URL fallback */
        .url-fallback {
            background-color: #0a0f1d;
            border: 1px solid #1e293b;
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 16px;
        }

        .url-label {
            color: #475569;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .url-text {
            color: #3b82f6;
            font-size: 12px;
            word-break: break-all;
            line-height: 1.5;
        }

        /* Warning */
        .warning-box {
            background-color: rgba(234, 179, 8, 0.05);
            border: 1px solid rgba(234, 179, 8, 0.2);
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 20px;
        }

        .warning-text {
            color: #a16207;
            font-size: 12px;
            line-height: 1.6;
        }

        /* Footer */
        .card-footer {
            background-color: rgba(15, 23, 42, 0.8);
            border-top: 1px solid #1e293b;
            padding: 20px 40px;
            text-align: center;
        }

        .footer-instansi {
            color: #334155;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .footer-year {
            color: #1e293b;
            font-size: 11px;
        }

        /* Outside footer */
        .outside-note {
            text-align: center;
            margin-top: 28px;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.6;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .card-body {
                padding: 28px 24px 24px;
            }

            .card-footer {
                padding: 16px 24px;
            }

            .card-title {
                font-size: 19px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">

            <!-- Header Logo -->
            <div class="header">
                <div class="logo-wrap">
                    <!-- Inventory Icon -->
                    <div class="logo-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14v4m0 0l8 4m-8-4l-8 4m8 4l8-4"
                                stroke="#ffffff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <div class="logo-title">Sistem Inventaris</div>
                        <div class="logo-subtitle">BPMP Maluku Utara</div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card">
                <div class="card-accent"></div>

                <div class="card-body">

                    <!-- Icon & Title -->
                    <div class="icon-section">
                        <div class="key-icon-wrap">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"
                                    stroke="#3b82f6" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="card-title">Reset Kata Sandi</div>
                        <div class="card-lead">Permintaan reset kata sandi diterima</div>
                    </div>

                    <hr class="divider">

                    <!-- Greeting -->
                    <div class="greeting">
                        Halo, <strong>{{ $userName }}</strong>.<br><br>
                        Kami menerima permintaan untuk mereset kata sandi akun Anda di
                        <strong>Sistem Inventaris IT & Publikasi BPMP Maluku Utara</strong>.
                        Klik tombol di bawah untuk membuat kata sandi baru.
                    </div>

                    <!-- CTA Button -->
                    <div class="btn-wrap">
                        <a href="{{ $resetUrl }}" class="btn-reset" target="_blank">
                            🔐 &nbsp; Reset Kata Sandi Saya
                        </a>
                    </div>

                    <!-- Info Box -->
                    <div class="info-box">
                        <div class="info-box-row">
                            <div class="info-dot" style="background-color:#3b82f6;"></div>
                            <div class="info-text">
                                Tautan ini hanya berlaku selama <strong>{{ $expireMinutes }} menit</strong> sejak email
                                ini dikirim.
                            </div>
                        </div>
                        <div class="info-box-row">
                            <div class="info-dot" style="background-color:#3b82f6;"></div>
                            <div class="info-text">
                                Tautan hanya dapat digunakan <strong>satu kali</strong> dan akan kadaluarsa setelah
                                dipakai.
                            </div>
                        </div>
                        <div class="info-box-row">
                            <div class="info-dot" style="background-color:#f59e0b;"></div>
                            <div class="info-text">
                                Jika Anda <strong>tidak merasa</strong> melakukan permintaan ini, abaikan email ini —
                                kata sandi Anda tetap aman.
                            </div>
                        </div>
                    </div>

                    <!-- URL Fallback -->
                    <div class="url-fallback">
                        <div class="url-label">Tombol tidak berfungsi? Salin tautan ini ke browser:</div>
                        <div class="url-text">{{ $resetUrl }}</div>
                    </div>

                    <!-- Warning -->
                    <div class="warning-box">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"
                            style="color:#a16207; flex-shrink:0; margin-top:1px;">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="warning-text">
                            Jangan bagikan tautan ini kepada siapapun. Tim kami tidak akan pernah meminta tautan reset
                            kata sandi Anda.
                        </div>
                    </div>

                </div>

                <!-- Card Footer -->
                <div class="card-footer">
                    <div class="footer-instansi">IT &amp; Publikasi · BPMP Maluku Utara</div>
                    <div class="footer-year">&copy; {{ date('Y') }} Sistem Inventaris. Semua hak dilindungi.</div>
                </div>
            </div>

            <!-- Outside note -->
            <div class="outside-note">
                Email ini dikirim otomatis oleh sistem.<br>
                Mohon tidak membalas email ini.
            </div>

        </div>
    </div>
</body>

</html>
