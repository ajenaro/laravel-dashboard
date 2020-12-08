<div class="form-group">
    <label for="team_id">Team</label>
    <select name="team_id" id="team_id" class="form-control">
        <option value="">Selecciona un equipo</option>
        @foreach($teams as $team)
            <option value="{{ $team->id }}"{{ old('team_id', $user->team_id) == $team->id ? ' selected' : '' }}>
                {{ $team->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="profession_id">Profesión</label>
    <select name="profession_id" id="profession_id" class="form-control">
        <option value="">Selecciona una profesión</option>
        @foreach($professions as $profession)
            <option value="{{ $profession->id }}"{{ old('profession_id', $user->profile->profession_id) == $profession->id ? ' selected' : '' }}>
                {{ $profession->title }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Habilidades</label>
    <br>
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
</div>

<div class="form-group">
    <label for="state">Estado</label>
    <input type="checkbox" name="state" class="form-check-inline" id="state" {{ $user->state ? 'checked' : '' }}>
</div>
