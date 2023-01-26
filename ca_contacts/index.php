<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP| MySQL | React.js | Axios Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <!-- Load Babel Compiler -->
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    <div id="root"></div>
	<script type="text/babel">
        class ContactForm extends React.Component {
            state = {
                name: '',
                email: '',
                country: '',
                city: '',
                job: '',
            }

            handleFormSubmit( event ) {
                event.preventDefault();

                let formData = new FormData();
                formData.append('name', this.state.name)
                formData.append('email', this.state.email)
                formData.append('city', this.state.city)
                formData.append('country', this.state.country)
                formData.append('job', this.state.job)

                axios({
                    method: 'post',
                    url: '/kgworks/ca_contacts/api/contacts.php',
                    data: formData,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                })
                .then(function (response) {
                    //handle success
                    console.log(response);
                    window.location.reload(false);

                })
                .catch(function (response) {
                    //handle error
                    console.log(response);
                });
            }

            render(){
                return (
                <form>
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" value={this.state.name}
                        onChange={e => this.setState({ name: e.target.value })}/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value={this.state.email}
                        onChange={e => this.setState({ email: e.target.value })}/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Country</label>
                        <input class="form-control" type="text" name="country" value={this.state.country}
                        onChange={e => this.setState({ country: e.target.value })}/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>City</label>
                        <input class="form-control" type="text" name="city" value={this.state.city}
                        onChange={e => this.setState({ city: e.target.value })}/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Job</label>
                        <input class="form-control" type="text" name="job" value={this.state.job}
                        onChange={e => this.setState({ job: e.target.value })}/>
                    </div>
                    <div class="form-group col-md-6">
                        <input class="btn btn-primary" type="submit" onClick={e => this.handleFormSubmit(e)} value="Create Contact" />
                    </div>
                </form>);
            }
        }


        class App extends React.Component {
            state = {
                contacts: []
            }

            componentDidMount() {
                const url = '/kgworks/ca_contacts/api/contacts.php'
                axios.get(url).then(response => response.data)
                .then((data) => {
                this.setState({ contacts: data })
                console.log(this.state.contacts)
                })
            }

            render() {
                return (
                    <React.Fragment>
                        <div class="p-3">
                            <h1 class="pb-3">Contact Management</h1>
                            <table border='1' width='100%' class="form-group col-md-6">
                            <tr>
                                <th class="p-1">Name</th>
                                <th class="p-1">Email</th>
                                <th class="p-1">Country</th>
                                <th class="p-1">City</th>
                                <th class="p-1">Job</th>     
                            </tr>

                            {this.state.contacts.map((contact) => (
                            <tr>
                                <td class="p-1">{ contact.name }</td>
                                <td class="p-1">{ contact.email }</td>
                                <td class="p-1">{ contact.country }</td>
                                <td class="p-1">{ contact.city }</td>
                                <td class="p-1">{ contact.job }</td>
                            </tr>
                            ))}
                            </table>
                        </div>
                        <ContactForm />
                    </React.Fragment>
                );
            }
        }

        ReactDOM.render(<App />, document.getElementById('root'));
    </script>
</body>
</html>