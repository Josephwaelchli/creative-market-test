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
                                    <input id="first_name" class="form-control" type="text" v-model="first_name"/>
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input id="last_name" class="form-control" type="text" v-model="last_name"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="shop_category" class="form-label">Your Shop Category</label>
                                    <select id="shop_category" class="form-control" v-model="shop_category">
                                        <option value="3d">3d</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="portfolio_url" class="form-label">Portfolio Link</label>
                                    <input id="portfolio_url" class="form-control" type="text" @change="validatePortfolioURL" v-model.lazy="portfolio_url"/>
                                </div>
                            </div>
                            <div v-if="portfolio_url_unique" class="row">
                                <div class="col-sm-12">
                                    <label for="confirm_ownership" class="form-check-label">Yes, I confirm that the content I submit is authored by me</label>
                                    <input id="confirm_ownership" class="form-check-control" type="checkbox" v-model="owns_content_confirmed"/>
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
                                    <textarea id="online_store_list" class="form-control" placeholder="Enter Urls" v-model="online_store_list"></textarea>
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
                                <select id="questions_one" class="form-control" v-model="question_one">
                                    <option v-for="option in question_one_options" :value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="question_two" class="form-label">How would you describe your experience level as an online seller?</label>
                                <select id="question_two" class="form-control" v-model="question_two">
                                    <option v-for="option in question_two_options" :value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="question_one" class="form-label">How would you describe your understanding of business and marketing?</label>
                                <select id="question_one" class="form-control" v-model="question_three">
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
        }
    },
    methods: {
        submit: function (event) {
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
            }
        },
        isValidURL : function (url) {
            // Use regex to lightly check if string is likely a valid URL before making rest request to our servers.
            // Regex from: https://stackoverflow.com/a/49849482
            let res = url.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
            return (res !== null)
        },
        nextPage: function (event) {
            // TODO: validate data.
            this.page = 2;
        },
        previousPage: function (event) {
            this.page = 1;
        }
    }
}
</script>

<style scoped>

</style>
