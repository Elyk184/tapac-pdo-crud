<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 20%;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            color: #0056b3;
        }
        html, body {
	position: relative;
	width: 100vw;
	height: 100vh;
	margin: 0;
	padding: 0;
	overflow: hidden;
}

body {
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 0 5em;
	box-sizing: border-box;
	
	font-family: "Lato", verdana, sans-serif;
}

.horizontal.timeline {
	display: flex;
	position: relative;
	flex-direction: row;
	justify-content: space-between;
	align-items: center;
	width: 100%;
	
	&:before {
		content: '';
		display: block;
		position: absolute;
		
		width: 100%;
		height: .2em;
		background-color: lighten(#000, 95%);
	}
	
	.line {
		display: block;
		position: absolute;
		
		width: 50%;
		height: .2em;
		background-color: #8897ec;
	}
	
	.steps {
		display: flex;
		position: relative;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		width: 100%;
		
		.step {
			display: block;
			position: relative;
			bottom: calc(100% + 1em);
			padding: .33em;
			margin: 0 2em;
			box-sizing: content-box;

			color: #8897ec;
			background-color: currentColor;
			border: .25em solid white;
			border-radius: 50%;
			z-index: 500;

			&:first-child {
				margin-left: 0;
			}

			&:last-child {
				margin-right: 0;
				color: #71CB35;
			}

			span {
				position: absolute;

				top: calc(100% + 1em);
				left: 50%;
				transform: translateX(-50%);
				white-space: nowrap;
				color: #000;
				opacity: .4;
			}

			&.current {
				&:before {
					content: '';
					display: block;
					position: absolute;
					top: 50%;
					left: 50%;
					transform: translate(-50%, -50%);

					padding: 1em;
					background-color: currentColor;
					border-radius: 50%;
					opacity: 0;
					z-index: -1;

					animation-name: animation-timeline-current;
					animation-duration: 2s;
					animation-iteration-count: infinite;
					animation-timing-function: ease-out;
				}

				span {
					opacity: .8;
				}
			}
		}	
	}
}

@keyframes animation-timeline-current {
	from {
		transform: translate(-50%, -50%) scale(0);
		opacity: 1;
	}
	to {
		transform: translate(-50%, -50%) scale(1);
		opacity: 0;
	}
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Success!</h2>
        <p>Your address has been recorded successfully.</p>
        <a href="../../index.php">Go back to home</a>
    </div>
    <div class="horizontal timeline">
        <div class="steps">
            <div class="step">
                <span>To be prepared</span>
            </div>
            <div class="step">
                <span>Sent to logistics</span>
            </div>
            <div class="step current">
                <span>In preparation</span>
            </div>
            <div class="step">
                <span>Shipped</span>
            </div>
            <div class="step">
                <span>Delivered</span>
            </div>
        </div>
        
        <div class="line"></div>
    </div>
</body>
</html>