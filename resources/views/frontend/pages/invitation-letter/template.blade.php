<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Invitation Letter</title>

    <style>
        @font-face {
            font-family: 'kalpurush';
            src: url('{{ asset('fonts/kalpurush.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 297mm;
            height: 188.067mm;
            margin: 0;
            padding: 0;
        }

        .invitation {
            width: 297mm;
            height: 188.067mm;
            position: relative;
            overflow: hidden;
        }

        .invitation-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .invitation-image {
            width: 100%;
            height: 100%;
            display: block;
        }

        .student-name {
            position: absolute;
            top: 14%;
            left: 15%;
            width: 70%;
            margin: 0;
            text-align: center;
        }

        .student-name {
            font-family: 'kalpurush', sans-serif;
            font-size: 28px;
                aspect-ratio: 297 / 210;
            }
            .student-name-pdf {
        <div class="invitation">
            <img class="invitation-image" src="{{ $imageSrc }}" alt="">
            <p class="student-name">{{ $name }}</p>
        <div class="background-image">
            } finally {
                button.disabled = false;
            }
        }
    </script>

</body>
</html>
