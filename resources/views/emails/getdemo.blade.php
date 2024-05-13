@component('mail::message', ['name' => $name])

Hi {{$name}}

We’d love to show you a demo of our interactive board.  If you’re ready to see how our tools can help your classroom or school, click on the link below and find an open slot. We’ll talk to you soon.

Click here to schedule a 15 minute demo with us  https://calendly.com/upliftk12

Best,
Uplift K12 Team

@component('mail::button', ['url' => 'https://upliftk12.com/'])
    Visit our site
@endcomponent

@endcomponent
