let input = document.getElementById('addw');

input.addEventListener('click', (e)=>{
        e.preventDefault();
        const output = `<label>Add Weight</label>
                        <input type="text" name="weight"/>
                        <input class="btn btn-primary" type="submit" value="Submit"/>`;

        document.getElementById('addwee').innerHTML = output;
                       
});