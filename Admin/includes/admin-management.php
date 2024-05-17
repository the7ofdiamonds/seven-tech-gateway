<div class="management">
    <h1>Management</h1>

    <form method="post" class="create-account" id="create_account">
        <input className="input-username" type="text" name="username" placeholder="Username" onChange={handleChange} required />
        <input className="input-email" type="email" name="email" placeholder="Email" onChange={handleChange} required />

        <input className="input-password" type="password" name="password" placeholder="Password" onChange={handleChange} required />
        <input className="input-password" type="password" name="confirm-password" placeholder="Confirm Password" onChange={handleChange} required />

        <input className="input-name" type="text" name="nicename" placeholder="Nice Name (eg. /nicename)" onChange={handleChange} required />
        <input className="input-name" type="text" name="nickname" placeholder="Nickname" onChange={handleChange} required />

        <input className="input-name" type="text" name="firstname" placeholder="First Name" onChange={handleChange} required />
        <input className="input-name" type="text" name="lastname" placeholder="Last Name" onChange={handleChange} required />

        <input className="input-phone" type="tel" name="phone" placeholder="Phone" onChange={handleChange} required />

        <button type="submit">
            <h3>CREATE</h3>
        </button>
    </form>
</div>