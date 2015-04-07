<script type="text/javascript" src="js/setUpProfile.js"></script>

<div class="centered-popup" id="setUpProfilePopup">

	<div id="welcome-area">
		<h1 class="centered-text">Set Up Profile</h1>
		<p class="centered-text">In order to use the BFHS Alumni Network to its full capacity, you'll have to tell us a little about yourself</p>

		<a id="skipButton" class="button-gold" href="#">Skip</a>
		<a id="startButton" class="button-gold" href="#">Continue</a>

	</div>

	<div id="location-area">
		<h2 class="centered-text">Location</h2>

		<input type="text" id="city" placeholder="City" />
		<select id="state">
			<option value="default">State</option>
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District Of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
		</select>
		
	</div>

	<div id="job-area">
		<h2 class="centered-text">Profession</h2>
		<input type="text" id="job" placeholder="Profession" />
		<input type="text" id="employer" placeholder="Employer (Optional)" />
	</div>

	<div id="contact-area">
		<h2 class="centered-text">Contact information</h2>

		<div id="emailCheckbox"><input type="checkbox" name="showEmail" id="showEmail" /> <label for="showEmail">Show email on profile?</label></div>
		<input type="text" id="facebookLink" placeholder="Facebook Link (Optional)" />
		<input type="text" id="twitterLink" placeholder="Twitter Link (Optional)" />

	</div>

	<div id="picture-area">
		<h2 class="centered-text">Upload a profile picture</h2>
		<input type="file" id="fileToUpload" accept=".png,.jpg,.jpeg" />
	</div>
  
  <div id="finished-area">
    <h2>Your profile is set up!</h2>
    <h3>If you want to make changes to your profile in the future, go to Settings</h3>
  </div>

	<span id="errors" class="error-span centered-text"></span>

	<div id="buttonGroup">
		<a id="backButton" class="button-gold" href="#">Back</a>
		<a id="nextButton" class="button-gold" href="#">Next</a>
		<a id="doneButton" class="button-gold" href="#">Done</a>
	</div>

</div>