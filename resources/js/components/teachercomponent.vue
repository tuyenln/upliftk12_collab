<template>
    <div class="content-vue">
        <div class="clearfix header-section-content">
            <h3 class="title-content">Room ID 010820 - Lesson 4.7A Angles demo</h3>
        </div>
        <div class="fw-ct">
          <div class="chosepeople">
            <select class="form-control" name="chosestudent">
                <option value="">Chose Student</option>
                <option value="">Mai Khởi Công</option>
                <option value="">Mai Xin Nghỉ</option>
            </select>
          </div>
        </div>
        <div class="fw-ct">  
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                <h5>Teacher Screen</h5>
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                </div>
                <div class="bottom-nodejs">
                  <input class="form-control" type="text" name="notifications" placeholder="notifications">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <h5>Sinh Viên Cá Biệt</h5>
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                </div>
                <div class="bottom-nodejs">
                  <div class="content-chat">
                      <p>Vui lòng viết liền không dấu oke </p>
                  </div>
                  <input class="form-control" type="text" name="typetext" placeholder="type writing">
                </div>
              </div>
            </div>        
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>