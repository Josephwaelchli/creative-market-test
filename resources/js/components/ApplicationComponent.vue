<template>
    <div class="container d-flex vh-100 align-content-center justify-content-center">
        <div class="row align-content-center justify-content-center">
            <div class="col-md-8">
                <div class="card align-middle">
                    <div class="card-body">
                        <div v-if="page<3" class="row">
                            <div class="col-sm-8 text-start">SELLER APPLICATION</div>
                            <div class="col-sm-4 text-end">STEP {{ page }} OF 2</div>
                        </div>
                        <div v-if="page===1">
                            <div class="row">
                                <h3>Share your work with us</h3>
                            </div>
                            <div class="row">
                                <p>To ensure the quality of our marketplace, we limit our seller community to the most qualified creators. Let our curators know why you'd be a great seller.</p>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input v-bind:class="{ 'border-danger': !validation.first_name}" v-model="first_name"
                                           id="first_name" class="form-control" type="text"/>
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input v-bind:class="{ 'border-danger': !validation.last_name}"  v-model="last_name"
                                           id="last_name" class="form-control" type="text"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="shop_category" class="form-label">Your Shop Category</label>
                                    <select v-bind:class="{ 'border-danger': !validation.shop_category}" v-model="shop_category" id="shop_category" class="form-control" >
                                        <option value="3d">3d</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="portfolio_url" class="form-label">Portfolio Link</label>
                                    <input @change="validatePortfolioURL" v-bind:class="{ 'border-danger': !validation.portfolio_url}"  v-model.lazy="portfolio_url"
                                           id="portfolio_url" class="form-control" type="text" />
                                </div>
                            </div>
                            <div v-if="portfolio_url_unique" class="row">
                                <div class="col-sm-12">
                                    <label for="confirm_ownership" class="form-check-label">Yes, I confirm that the content I submit is authored by me</label>
                                    <input  v-bind:class="{ 'border-danger': !validation.portfolio_url_unique}" v-model="owns_content_confirmed"
                                            id="confirm_ownership" class="form-check-control" type="checkbox"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset>
                                        <legend>Do you already have an online store?</legend>

                                        <input type="radio" class="form-check-input" id="online_store_yes" value="yes" v-model="online_store">
                                        <label for="online_store_yes" class="form-check-label">Yes</label>

                                        <input type="radio" class="form-check-input" id="online_store_no" value="no" v-model="online_store">
                                        <label for="online_store_no" class="form-check-label">No</label>
                                    </fieldset>
                                </div>
                            </div>
                            <div v-if="online_store==='yes'" class="row">
                                <div class="col-sm-12">
                                    <label for="online_store_list" class="form-label">Online stores I sell on today</label>
                                    <textarea v-bind:class="{ 'border-danger': !validation.online_store_list}" v-model="online_store_list"
                                              id="online_store_list" class="form-control" placeholder="Enter Urls" ></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-primary float-end" @click="nextPage">Next</a>
                                </div>
                            </div>
                        </div>
                        <div v-if="page===2">
                            <div class="row">
                                <h3>Tell us a little about yourself</h3>
                            </div>
                            <div class="row">
                                <p>Your answers will help us provide you with a more personalized experience as a seller!</p>
                            </div>
                            <div class="row">
                                <label for="questions_one" class="form-label">When creating product to sell, which best describes your perspective on quality?</label>
                                <select v-bind:class="{ 'border-danger': !validation.question_one}" v-model="question_one"
                                        id="questions_one" class="form-control">
                                    <option v-for="option in question_one_options" :value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="question_two" class="form-label">How would you describe your experience level as an online seller?</label>
                                <select v-bind:class="{ 'border-danger': !validation.question_two}" v-model="question_two"
                                        id="question_two" class="form-control">
                                    <option v-for="option in question_two_options" :value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="question_one" class="form-label">How would you describe your understanding of business and marketing?</label>
                                <select v-bind:class="{ 'border-danger': !validation.question_three}" v-model="question_three"
                                        id="question_one" class="form-control">
                                    <option v-for="option in question_three_options" :value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a @click="previousPage" class="float-start">< Back</a>
                                </div>
                                <div class="col-sm-6">
                                    <a @click="submit" class="btn btn-primary float-end">Submit Application</a>
                                </div>
                            </div>
                        </div>
                        <div v-if="page===3">
                            <div class="row">
                                <img src="images/icon-sent.png" alt="Application Sent"/>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Thank you for applying to become a seller with Creative Market!</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                        Our curators are reviewing your application. We'll get back to you within <b>5-7 business days.</b>
                                        Meanwhile you already have access to your Shop Studio, so let's start setting up your store!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApplicationComponent",
    data: function () {
        let createAnswer = function (selectOption) {
            return {value: selectOption, text: selectOption};
        }
        let questionOneAnswers = [
            createAnswer("I don't care what it takes, my products are the highest quality possible"),
            createAnswer("I put in enough effort to make my product pretty high quality, but at some point my time is better spent elsewhere"),
            createAnswer("I try to get quality products out quickly, even if I need to take a shortcut now and then"),
            createAnswer("I spend the minimum amount of time & effort it takes to create products that are acceptable quality"),
            createAnswer("Quantity is more important to me than quality")
        ];
        let questionTwoAnswers = [
            createAnswer("I sell on multiple marketplaces and through my own website"),
            createAnswer("I have experience selling through only my own website"),
            createAnswer("I have experience selling through multiple marketplaces"),
            createAnswer("I have experience selling through one online marketplace"),
            createAnswer("I'm new to selling creative products online")
        ];
        let questionThreeAnswers = [
            createAnswer("I have an extensive background in business and/or marketing"),
            createAnswer("I'm familiar with some skills & techniques, but I'm not sure how to apply them when selling my creative work"),
            createAnswer("I'm vaguely aware of basic business & marketing concepts"),
            createAnswer("I'm not interested in understanding business & marketing")
        ];

        return {
            page: 1,
            portfolio_url_unique: false,
            owns_content_confirmed: false,
            first_name: "",
            last_name: "",
            shop_category: "",
            portfolio_url: "",
            online_store: "",
            online_store_list: "",
            question_one: "",
            question_two: "",
            question_three: "",
            question_one_options: questionOneAnswers,
            question_two_options: questionTwoAnswers,
            question_three_options: questionThreeAnswers,
            validation : {
                first_name : true,
                last_name : true,
                shop_category : true,
                portfolio_url : true,
                portfolio_url_unique : true,
                online_store_list : true,
                question_one : true,
                question_two : true,
                question_three : true,
            }
        }
    },
    methods: {
        submit: function (event) {
            if (this.validatePageOne() && this.validatePageTwo()) {

                let self = this;
                axios({
                    method: 'post',
                    url: 'api/v1/sellerApplications',
                    data: {
                        first_name : this.first_name,
                        last_name : this.last_name,
                        owns_content_confirmed : this.owns_content_confirmed,
                        shop_category : this.shop_category,
                        portfolio_url : this.portfolio_url,
                        meta : JSON.stringify({
                            online_store_list : this.online_store_list,
                            answers : {
                                one : this.question_one,
                                two : this.question_two,
                                three : this.question_three,
                            },
                        }),
                    }
                }).then(function (response) {
                    self.page = 3;
                });
            }
        },
        validatePortfolioURL: function (event) {
            let self = this;
            if (this.isValidURL(this.portfolio_url)) {
                axios({
                    method: 'post',
                    url: 'api/v1/sellerApplications/portfolioUnique',
                    data : {
                        portfolio_url : this.portfolio_url,
                    }
                }).then(function (response) {
                    self.portfolio_url_unique = response.data.unique;
                });
            } else {
                this.portfolio_url_unique = false;
            }
        },
        isValidURL : function (url) {
            // Use regex to lightly check if string is likely a valid URL before making rest request to our servers.
            // Regex from: https://stackoverflow.com/a/49849482
            let res = url.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
            return (res !== null)
        },
        nextPage: function (event) {
            if (this.validatePageOne()) {
                this.page = 2;
            }
        },
        previousPage: function (event) {
            this.page = 1;
        },
        validatePageOne: function () {
            let valid = true;
            if (this.first_name === "") {
                valid = false;
                this.validation.first_name = false;
            } else {
                this.validation.first_name = true;
            }
            if (this.last_name === "") {
                valid = false;
                this.validation.last_name = false;
            } else {
                this.validation.last_name = true;
            }
            if (this.portfolio_url_unique === false) {
                valid = false;
                this.validation.portfolio_url_unique = false;
            } else {
                this.validation.portfolio_url_unique = true;
            }
            if (this.portfolio_url === "") {
                valid = false;
                this.validation.portfolio_url = false;
            } else {
                this.validation.portfolio_url = true;
            }
            if (this.shop_category === "") {
                valid = false;
                this.validation.shop_category = false;
            } else {
                this.validation.shop_category = true;
            }
            if (this.online_store === "yes" && this.online_store_list === "") {
                valid = false;
                this.online_store_list = false;
            } else {
                this.online_store_list = true;
            }
            return valid;
        },
        validatePageTwo: function () {
            let valid = true;
            if (this.question_one === "") {
                valid = false;
                this.validation.question_one = false;
            } else {
                this.validation.question_one = true;
            }
            if (this.question_two === "") {
                valid = false;
                this.validation.question_two = false;
            } else {
                this.validation.question_two = true;
            }
            if (this.question_three === "") {
                valid = false;
                this.validation.question_three = false;
            } else {
                this.validation.question_three = true;
            }
            return valid;
        },
    }
}
</script>

<style scoped>

</style>
