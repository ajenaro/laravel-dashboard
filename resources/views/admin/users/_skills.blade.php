<h5>Habilidades</h5>
@foreach($skills as $skill)
    <div class="form-check form-check-inline">
        <input name="skills[{{ $skill->id }}]"
               class="form-check-input"
               type="checkbox"
               id="skill_{{ $skill->id }}"
               value="{{ $skill->id }}"
            {{ ($errors->any() ? old("skills.{$skill->id}") : $user->skills->contains($skill)) ? 'checked' : '' }}>
        <label class="form-check-label" for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
    </div>
@endforeach
